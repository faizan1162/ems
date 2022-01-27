<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Event Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <router-link  to="/dashboard">Home</router-link>
                            </li>
                            <li class="breadcrumb-item active">Event Details</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="img-fluid" :src="$helpers.getImageUrl(event.event_avatar)" alt="Event Image" height="300">
                            </div>
                            <h3 class="profile-username text-center">{{ event.event_title }}</h3>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Start Date</b> <a class="float-right">{{ event.event_start_date+" "+event.event_start_time }}</a>
                                </li>
                                 <li class="list-group-item">
                                    <b>End Date</b> <a class="float-right">{{ event.event_end_date+" "+event.event_end_time }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Location</b> <a class="float-right">{{event.event_location}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Total Participants</b> <a class="float-right">{{ event.participants_count }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Booking Confirmed</b> <a class="float-right">{{ event.ticket_bookings_count }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Total Earnings</b> <a class="float-right">{{ getTotalEarnings(ticket_bookings) }}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
                 <div class="col-md-9 col-sm-12">
                    <div class="row">
                        <div class="col-sm-12 col-md-8">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Ticket Summary</h3>
                                </div>
                                <div class="card-body box-profile">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Price</th>
                                                <th>Total Qty</th>
                                                <th>Sold</th>
                                                <th>Available</th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(ticket, index) in event.event_tickets" :key="index">
                                                <td>{{ ticket.ticket_type.type }}</td>
                                                <td>{{ ticket.ticket_price }}</td>
                                                <td>{{ (ticket.qty) }}</td>
                                                <td>{{ (ticket.sold_qty) }}</td>
                                                <td>{{ (ticket.qty - ticket.sold_qty) }}</td>
                                            
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Add Participant</h3>
                                </div>
                                <div class="card-body box-profile">
                                    <form id="form1" role="form" method="post" @submit.prevent="addParticipant">
                                        <div class="form-group">
                                            <select name="user_id" class="form-control" required v-model="this.user_id">
                                                <option  v-for="(user, index) in users" :key="index" v-bind:value="user.id">{{user.full_name + " ("+user.email+")" }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                        <button class="btn btn-primary" type="submit" :disabled="btnDisabled ? true : false">
                                                <div class="fa-2x" v-if="btnDisabled"><i class="fas fa-sync fa-spin"></i></div>
                                                Add Participant
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                    
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Event Participants</h3>
                            <div class="card-tools">
                                <button type="submit" class="btn btn-primary" @click="getEventTicketBookings()"><i class="fas fa-sync-alt"></i></button>
                            </div>
                        </div>
                        <div class="card-body box-profile">
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
                                <table id="driver-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Paticipant Name</th>
                                            <th>Email</th>
                                            <th>Booking Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if="isLoading">
                                            <td colspan="6" class="text-center"><div class="fa-3x"><i class="fas fa-sync fa-spin"></i></div></td>
                                        </tr>
                                        <tr v-if="!isLoading && table.rows.length == 0">
                                            <td colspan="6" class="text-center">No Data Found</td>
                                        </tr>
                                        <tr  v-for="(epUser, index) in table.rows" :key="index">
                                            <td>{{ index+1 }}</td>
                                            <td>{{ epUser.user.full_name }}</td>
                                            <td>{{ epUser.user.email }}</td>
                                            <td v-html="getTicketBookingStatus(epUser.status)"></td>
                                            <td>{{ $helpers.utcToLocal(epUser.created_at) }}</td>
                                            <td> <router-link  v-if="epUser.status == 0"
                                               :to="{
                                                    name: 'TicketBook',
                                                    query: { event_id: epUser.event_id,user_id:epUser.user_id }
                                                }"
                                                class="text-white btn-sm btn-primary" 
                                                title="Event TicketBook">
                                                    <i class="fas fa-ticket-alt"></i>
                                                </router-link></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</template>
<script>
import { _ADD_EVENT_PARTICIPANT, _EVENT_DETAILS,_GET_EVENT_PARTICIPANT, ERROR_SOMETHING_WENT_WRONG } from "../../config/constants";
import api from "../../http-common";
export default {
    name : 'EventDetails',
    params: ['slug'],
    data() {
        return {
            btnDisabled: false,
            isLoading: true,
            event:{},
            user_id: 0,
            users:[],
            isShow:false,
            ticket_bookings : [],
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
        this.getEventDetails();
        this.getEventParticipants();
    },
    methods : {
        async getEventDetails() {
            let myRoute = _EVENT_DETAILS.route + this.$route.params.slug;
            const response = await api.execute(_EVENT_DETAILS, myRoute);
            if (response && response.success == 1) {
                this.event = response.data;
                this.users = response.data.users;
                this.ticket_bookings = this.event.ticket_bookings;
             } else if (response && response.success == 0) {
                this.$toast.error(response.message);
            } else {
                this.$toast.error(ERROR_SOMETHING_WENT_WRONG);
            }
        },
        async getEventParticipants(){
            this.isLoading = true;
            let myRoute = _GET_EVENT_PARTICIPANT.route + this.$route.params.slug+"/participants";
            const response = await api.execute(_GET_EVENT_PARTICIPANT, myRoute);
            if (response && response.success == 1) {
                this.isLoading = false;
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
            } else if (response && response.success == 0) {
                this.$toast.error(response.message);
            } else {
                this.$toast.error(ERROR_SOMETHING_WENT_WRONG);
            }
        },
        async nextPage(){
            this.isLoading = true;
            const response = await api.execute(_GET_EVENT_PARTICIPANT, this.table.next_page_url);
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
            const response = await api.execute(_GET_EVENT_PARTICIPANT, this.table.prev_page_url);
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
        async addParticipant() {
            this.btnDisabled = true;
            let formData = new FormData();
            formData.append('event_id',this.event.id);
            formData.append('user_id',this.user_id);
            const response = await api.execute(_ADD_EVENT_PARTICIPANT,_ADD_EVENT_PARTICIPANT.route,formData);
            if (response && response.success == 1) {
                 this.btnDisabled = false;
                this.$toast.success("Participant added successfully");
                this.getEventDetails();
                this.getEventParticipants();
            } else if (response && response.success == 0) {
                this.btnDisabled = false;
                this.$toast.error(response.message);
            } else {
                this.btnDisabled = false;
                this.$toast.error(ERROR_SOMETHING_WENT_WRONG);
            }
        },
        getTicketBookingStatus(status){
            return (status == 1?"<span class='badge badge-success'>Ticket Booked</span>":"<span class='badge badge-warning'>Pending</span>");
        },
        getTotalEarnings(ticket_bookings){
            let total_earnings = 0;
            if(ticket_bookings.length > 0){
                ticket_bookings.forEach(ticket => {
                    total_earnings += ticket.total_price;
                });
                return total_earnings;
            }else{
                return 0;
            }
        }
    },
}
</script>
