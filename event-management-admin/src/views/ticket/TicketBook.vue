<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>ADD Event Ticket</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                               <router-link  to="/tickets">All Tickets</router-link>
                            </li>
                            <li class="breadcrumb-item active">Add</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div v-if="isLoading">
                                    <div class="text-center"><div class="fa-3x"><i class="fas fa-sync fa-spin"></i></div></div>
                                </div>
                                <div v-else>
                                    <form id="form1" role="form" method="post" @submit.prevent="addTicket">
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="title">Event Title<span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control"
                                                            name="title" id="title"
                                                            minlength="3"
                                                            maxlength="255"
                                                            placeholder="Event Title"
                                                            :value="event.event_title" readonly>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="pname">Participant Name: <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control validate[required]" name="user_name"
                                                                    id="pname" placeholder="Name" :value="user.full_name"  readonly/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Participant Email:</label>
                                                                <input type="email" id="email" name="email" :value="user.email" class="form-control"  placeholder="Email" readonly />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="title">Event Location<span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control"
                                                            name="event_location" id="event_location"
                                                            minlength="3"
                                                            maxlength="255"
                                                            placeholder="Event Location"
                                                            :value="event.event_location" readonly>
                                                    </div>
                                                   <div class="row">
                                                       <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="tprice">Select Ticket Type: <span class="text-danger">*</span></label>
                                                                <select name="ticket_type" class="form-control" required v-model="ticket_selected" v-on:change="onTicketSelectedData">
                                                                    <option  v-for="(ticket, index) in event.event_tickets" :key="index" v-bind:value="{ id:ticket.ticket_type_id,type:ticket.ticket_type.type,price:ticket.ticket_price,qty:ticket.qty,sold_qty:ticket.sold_qty }">{{ticket.ticket_type.type + " | Available: "+(ticket.qty - ticket.sold_qty) }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="tprice">Ticket Price: <span class="text-danger">*</span></label>
                                                                <input type="number" class="form-control validate[required]" name="ticket_price"
                                                                    id="tprice" placeholder="Ticket Price" :value="ticket_price" readonly/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label>Qty:</label>
                                                                <input type="number" id="qty" name="qty" class="form-control" placeholder="Enter Quantity" :value="qty" readonly />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer">
                                            <button class="btn btn-primary" type="submit" :disabled="btnDisabled ? true : false">
                                                <div class="fa-2x" v-if="btnDisabled"><i class="fas fa-sync fa-spin"></i></div>
                                                Add Ticket
                                            </button>&nbsp;
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col -->

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
</template>
<script>
    import {   _ADD_EVENT_TICKET,_GET_EVENT_AND_USER_DETAILS, ERROR_SOMETHING_WENT_WRONG } from "../../config/constants";
    import api from "../../http-common";
    export default {
        name: 'TicketBook',
        data() {
            return {
                isLoading: false,
                btnDisabled: false,
                qty: 0,
                ticket_price: 0,
                ticket_selected: "",
                event: {},
                user: {
                    id : 0,
                    full_name : "",
                    email: "",
                },
            }
        },
        created(){
            this.getEventAndUserDetails();
        },
        methods: {
           async getEventAndUserDetails(){
                var myRoute = _GET_EVENT_AND_USER_DETAILS.route+"?event_id="+this.$route.query.event_id+"&user_id="+this.$route.query.user_id;
                const response = await api.execute(_GET_EVENT_AND_USER_DETAILS,myRoute);
                if (response && response.success == 1) {
                    this.$toast.success("Event and User Found");
                    this.event = response.data;
                    this.user = this.event.user;
                } else if (response && response.success == 0) {
                    this.btnDisabled = false;
                    this.$toast.error(response.message);
                } else {
                    this.btnDisabled = false;
                    this.$toast.error(ERROR_SOMETHING_WENT_WRONG);
                }
           },
           onTicketSelectedData(){
                console.log(this.ticket_selected) 
                if( (this.ticket_selected.qty - this.ticket_selected.sold_qty) > 0 ){
                   this.qty = 1;
                   this.ticket_price = this.ticket_selected.price;
                }else{
                   this.qty = 0;
                   this.$toast.error(this.ticket_selected.type+" Ticket Not Available");
                }
           },
           async addTicket() {
                this.btnDisabled = true;
                let formData = new FormData();
                formData.append('event_id',this.event.id);
                formData.append('user_id',this.user.id);
                formData.append('total_price',this.ticket_selected.price);
                formData.append('event_ticket_type_id',this.ticket_selected.id);
                formData.append('event_ticket_type',this.ticket_selected.type);
                formData.append('event_ticket_price',this.ticket_selected.price);
                formData.append('event_ticket_qty',1);
                
                if(this.qty > 0){
                    const response = await api.execute(_ADD_EVENT_TICKET,_ADD_EVENT_TICKET.route,formData);
                    if (response && response.success == 1) {
                        this.$toast.success("Event Ticket added successfully");
                        window.location.href = "/tickets";
                    } else if (response && response.success == 0) {
                        this.btnDisabled = false;
                        this.$toast.error(response.message);
                    } else {
                        this.btnDisabled = false;
                        this.$toast.error(ERROR_SOMETHING_WENT_WRONG);
                    }
                }else{
                    this.$toast.error(this.ticket_selected.type+" Ticket Not Available");
                }
            },
        },
        mounted() {
           
        }
    }
</script>
