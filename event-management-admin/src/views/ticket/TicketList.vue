<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Ticket List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <router-link  to="/dashboard">Home</router-link>
                            </li>
                            <li class="breadcrumb-item active">Tickets</li>
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
                                <button type="submit" class="btn btn-primary" @click="getAllTickets()"><i class="fas fa-sync-alt"></i></button>
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
                                        <tr  v-for="(ticket, index) in table.rows" :key="index">
                                            <td>{{ index+1 }}</td>
                                            <td>
                                                 <router-link
                                               :to="{
                                                    name: 'EventDetails',
                                                    params: { slug: ticket.event_id },
                                                }"
                                                title="Event Details">
                                                    {{ ticket.event.event_title }}
                                                </router-link>
                                            </td>
                                            <td>{{ ticket.user.full_name }}</td>
                                            <td v-html="getEventTicketDetails(ticket.event_ticket_booking_details)"></td>
                                            <td>{{ $helpers.utcToLocal(ticket.created_at) }}</td>
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
import { _ALL_TICEKT_BOOKINGS,ERROR_SOMETHING_WENT_WRONG } from "../../config/constants";
import api from "../../http-common";
export default {
    name : 'TicketList',
    data() {
        return {
            eventHeading: "All",
            isLoading: true,
            isLoading2: false,
            blockedDriverId: 0,
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
        this.getAllTickets();
    },
    methods : {
        async getAllTickets() {
            this.isLoading = true;
            const response = await api.execute(_ALL_TICEKT_BOOKINGS, _ALL_TICEKT_BOOKINGS.route);
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
            const response = await api.execute(_ALL_TICEKT_BOOKINGS, this.table.next_page_url);
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
            const response = await api.execute(_ALL_TICEKT_BOOKINGS, this.table.prev_page_url);
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