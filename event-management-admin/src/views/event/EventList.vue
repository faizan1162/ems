<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ eventHeading }} Events</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <router-link  to="/dashboard">Home</router-link>
                            </li>
                            <li class="breadcrumb-item active">Events</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">DETAILS</h3>
                            <div class="card-tools">
                                <button type="submit" class="btn btn-primary" @click="getAllEvents()"><i class="fas fa-sync-alt"></i></button>
                            </div>
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
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Ticket Available</th>
                                            <th>Location</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if="isLoading">
                                            <td colspan="7" class="text-center"><div class="fa-3x"><i class="fas fa-sync fa-spin"></i></div></td>
                                        </tr>
                                        <tr v-if="!isLoading && table.rows.length == 0">
                                            <td colspan="7" class="text-center">No Data Found</td>
                                        </tr>
                                        <tr  v-for="(event, index) in table.rows" :key="index">
                                            <td>{{ index+1 }}</td>
                                            <td>{{ event.event_title }}</td>
                                            <td>{{ event.event_start_date+" "+event.event_start_time }}</td>
                                            <td>{{ event.event_end_date+" "+event.event_end_time }}</td>
                                            <td v-html="getEventTicketDetails(event.event_tickets)"></td>
                                            <td>{{ event.event_location }}</td>
                                            <td> 
                                                <router-link
                                               :to="{
                                                    name: 'EventDetails',
                                                    params: { slug: event.id },
                                                }"
                                                class="text-white btn-sm btn-primary" 
                                                title="Event Details">
                                                    <i class="fa fa-eye"></i>
                                                </router-link>
                                            </td>
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
import { _ALL_EVENTS,ERROR_SOMETHING_WENT_WRONG } from "../../config/constants";
import api from "../../http-common";
export default {
    name : 'EventList',
    data() {
        return {
            eventHeading: "All",
            isLoading: true,
            btnDisabled: false,
            isShow : false,
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
        this.getAllEvents();
    },
    methods : {
        async getAllEvents() {
            this.isLoading = true;
            let myRoute = _ALL_EVENTS.route+"?type="+this.getEventParam();
            this.eventHeading = this.getEventParam();
            const response = await api.execute(_ALL_EVENTS, myRoute);
            if (response && response.success == 1) {
                this.isLoading = false;
                if(response.data.data !== undefined){
                    this.table.rows = response.data.data;
                    this.table.totalRecordCount = response.data.total;
                    this.table.next_page_url = response.data.next_page_url;
                    this.table.prev_page_url = response.data.prev_page_url;
                    this.table.from = response.data.from;
                    this.table.to = response.data.to;
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
            let myRoute = this.table.next_page_url+"&type="+this.getEventParam();
            const response = await api.execute(_ALL_EVENTS, myRoute);
            if (response && response.success == 1) {
                this.isLoading = false;
                this.table.rows = response.data.data;
                this.table.totalRecordCount = response.data.total;
                this.table.next_page_url = response.data.next_page_url;
                this.table.prev_page_url = response.data.prev_page_url;
                this.table.from = response.data.from;
                this.table.to = response.data.to;
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
            let myRoute = this.table.prev_page_url+"&type="+this.getEventParam();
            const response = await api.execute(_ALL_EVENTS, myRoute);
            if (response && response.success == 1) {
                this.isLoading = false;
                this.table.rows = response.data.data;
                this.table.totalRecordCount = response.data.total;
                this.table.next_page_url = response.data.next_page_url;
                this.table.prev_page_url = response.data.prev_page_url;
                this.table.from = response.data.from;
                this.table.to = response.data.to;
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
        getEventParam(){
            let ds = this.$route.query.type;
            if(ds == undefined){
                ds = "all";
            }
            return ds;
        },
        getEventTicketDetails(event_tickets){
           let etd = "";
           if(event_tickets.length){
               event_tickets.forEach(ticket => {
                   etd += ticket.ticket_type.type+" : "+(ticket.qty - ticket.sold_qty)+" <br> ";
               });
           }
           return etd;
        },
        getId(data){
            return (data != null?data.id:0);
        },
    },
}
</script>