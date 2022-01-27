<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sales Report</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <router-link  to="/dashboard">Home</router-link>
                            </li>
                            <li class="breadcrumb-item active">Sales Report</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <form class="search-form" method="post" @submit.prevent="searchSalesReport">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <select name="event_id" class="form-control" required v-model="event_id">
                                <option  v-for="(event, index) in events" :key="index" v-bind:value="event.id">{{event.event_title}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <select name="ticket_type_id" class="form-control" v-model="ticket_type_id">
                                <option value="0">All</option>
                                <option value="1">Silver</option>
                                <option value="2">Gold</option>
                                <option value="3">Platinum</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                    </div>
                </div>
             </form>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Total Earnings: {{ totalEarnings }}</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-information"  v-if="table.rows.length">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="text-left"><span>Showing {{ table.from }} to {{ table.to }} of {{ table.totalRecordCount }} entries: </span> </div>

                                    </div>
                                    <div class="col-sm-6">
                                        <div class="text-right">
                                            <button class="btn btn-sm btn-default" @click="previousPage" :disabled="table.preDisabled ? true : false">Previous</button>&nbsp;
                                            <button class="btn btn-sm btn-default" @click="nextPage" :disabled="table.nextDisabled ? true : false">Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="delivery-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Event Title</th>
                                            <th>Participant</th>
                                            <th>Ticket Summary</th>
                                            <th>Created Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if="isLoading">
                                            <td colspan="5" class="text-center"><div class="fa-3x"><i class="fas fa-sync fa-spin"></i></div></td>
                                        </tr>
                                        <tr v-if="!isLoading && table.rows.length == 0">
                                            <td colspan="5" class="text-center">No Data Found</td>
                                        </tr>
                                        <tr  v-for="(report, index) in table.rows" :key="index">
                                            <td>{{ index+1 }}</td>
                                            <td>
                                                 <router-link
                                               :to="{
                                                    name: 'EventDetails',
                                                    params: { slug: report.event_id },
                                                }"
                                                title="Event Details">
                                                    {{ report.event.event_title }}
                                                </router-link>
                                            </td>
                                            <td>{{ report.user.full_name }}</td>
                                            <td>{{ report.event_ticket_type }}</td>
                                            <td>{{ $helpers.utcToLocal(report.created_at) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</template>
<script>
import { _ALL_EVENT_LIST,_SALES_REPORT,ERROR_SOMETHING_WENT_WRONG } from "../../config/constants";
import api from "../../http-common";
export default {
    name : 'SalesReport',
    data() {
        return {
            isLoading: false,
            btnDisabled: false,
            isShow : false,
            ticket_type_id: 0,
            totalEarnings: 0,
            events:[],
            event_id: 1,
            table : {
                rows: [],
                totalRecordCount: 0,
                prev_page_url:"",
                next_page_url:"",
                preDisabled:true,
                nextDisabled:false,
                from:0,
                to:0,
            }
        }
    },
    created(){
        this.getAllEventList()
    },
    methods : {
        async searchSalesReport() {
            var myRoute = _SALES_REPORT.route+"?event_id="+this.event_id+"&ticket_type_id="+this.ticket_type_id;
            this.isLoading = true;
            const response = await api.execute(_SALES_REPORT, myRoute);
            if (response && response.success == 1) {
                this.isLoading = false;
                if(response.data.report.data !== undefined){
                    this.totalEarnings = response.data.earnings;
                    this.table.rows = response.data.report.data;
                    this.table.totalRecordCount = response.data.report.total;
                    this.table.next_page_url = response.data.report.next_page_url;
                    this.table.prev_page_url = response.data.report.prev_page_url;
                    this.table.from = response.data.report.from;
                    this.table.to = response.data.report.to;
                    if(this.table.next_page_url == null){
                        this.table.nextDisabled = true;
                        this.table.preDisabled = true;
                    }
                }
            } else if (response && response.success == 0) {
                this.$toast.error(response.message);
            } else {
                this.$toast.error(ERROR_SOMETHING_WENT_WRONG);
            }
        },
        async nextPage(){
            this.isLoading = true;
            var myRoute = this.table.next_page_url+"&event_id="+this.event_id+"&ticket_type_id="+this.ticket_type_id;
            const response = await api.execute(_SALES_REPORT, myRoute);
            if (response && response.success == 1) {
                this.isLoading = false;
                this.table.rows = response.data.report.data;
                this.table.totalRecordCount = response.data.report.total;
                this.table.next_page_url = response.data.report.next_page_url;
                this.table.prev_page_url = response.data.report.prev_page_url;
                this.table.from = response.data.report.from;
                this.table.to = response.data.report.to;
                if(this.table.prev_page_url != null){
                    this.table.preDisabled = false;
                }
                if(this.table.next_page_url == null){
                    this.table.nextDisabled = true;
                }
            } else if (response && response.success == 0) {
                this.$toast.error(response.message);
            } else {
                this.$toast.error(ERROR_SOMETHING_WENT_WRONG);
            }
        },
        async previousPage(){
            this.isLoading = true;
            var myRoute = this.table.prev_page_url+"&event_id="+this.event_id+"&ticket_type_id="+this.ticket_type_id;
            const response = await api.execute(_SALES_REPORT, myRoute);
            if (response && response.success == 1) {
                this.isLoading = false;
                this.table.rows = response.data.report.data;
                this.table.totalRecordCount = response.data.report.total;
                this.table.next_page_url = response.data.report.next_page_url;
                this.table.prev_page_url = response.data.report.prev_page_url;
                this.table.from = response.data.report.from;
                this.table.to = response.data.report.to;
                if(this.table.prev_page_url == null){
                    this.table.preDisabled = true;
                }
                if(this.table.next_page_url != null){
                    this.table.nextDisabled = false;
                }
            } else if (response && response.success == 0) {
                this.$toast.error(response.message);
            } else {
                this.$toast.error(ERROR_SOMETHING_WENT_WRONG);
            }
        },
        async getAllEventList() {
            const response = await api.execute(_ALL_EVENT_LIST, _ALL_EVENT_LIST.route);
            if (response && response.success == 1) {
                if(response.data !== undefined){
                    this.events = response.data;
                    if(this.events.length){
                        this.event_id = this.events[0].id;
                    }
                }
            } else if (response && response.success == 0) {
                this.$toast.error(response.message);
            } else {
                this.$toast.error(ERROR_SOMETHING_WENT_WRONG);
            }
        },
        getEventTicketDetails(event_tickets){
           let etd = "";
           if(event_tickets.length){
               event_tickets.forEach(ticket => {
                   etd += ticket.event_ticket_type+" | Price: "+ticket.event_ticket_price+" <br> ";
               });
           }
           return etd;
        },
    },
}
</script>