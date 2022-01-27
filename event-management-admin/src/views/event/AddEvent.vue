<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>ADD Event</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                               <router-link  to="/events">Events</router-link>
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
                                <h3 class="card-title">Add Event</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div v-if="isLoading">
                                    <div class="text-center"><div class="fa-3x"><i class="fas fa-sync fa-spin"></i></div></div>
                                </div>
                                <div v-else>
                                    <form id="form1" role="form" method="post" @submit.prevent="addEvent" enctype="multipart/form-data">
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="title">Event Title<span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control"
                                                            name="title" id="title"
                                                            required
                                                            minlength="3"
                                                            maxlength="255"
                                                            placeholder="Event Title"
                                                            v-model="event.event_title">
                                                    </div>
                                                     <div class="form-group">
                                                        <label for="title">Event Location<span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control"
                                                            name="event_location" id="event_location"
                                                            required
                                                            minlength="3"
                                                            maxlength="255"
                                                            placeholder="Event Location"
                                                            v-model="event.event_location">
                                                    </div>
                                                     <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="start_date">Start Date: <span class="text-danger">*</span></label>
                                                                <input type="date" class="form-control validate[required]"
                                                                    name="event_start_date"
                                                                    id="start_date" 
                                                                    placeholder="Start Date" 
                                                                    v-model="event.event_start_date">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Start Time:</label>
                                                                <input type="time" id="appt" name="event_start_time" class="form-control" v-model="event.event_start_time">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="end_date">End Date: <span class="text-danger">*</span></label>
                                                                <input type="date" class="form-control validate[required]"  name="event_end_date"
                                                                    id="end_date" placeholder="End Date" v-model="event.event_end_date">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>End Time:</label>
                                                                <input type="time" id="appt" name="event_end_time" class="form-control" v-model="event.event_end_time">
                                                            </div>
                                                        </div>
                                                    </div>
                                        
                                                     <div class="form-group">
                                                        <label for="title">Event Desctiption<span class="text-danger">*</span></label>
                                                       <textarea class="form-control"
                                                            name="event_description" id="event_description"
                                                            required
                                                            minlength="3"
                                                            maxlength="255"
                                                            placeholder="Event Description"
                                                            v-model="event.event_description"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                     <div class="form-group">
                                                        <label for="tImage">Event Image <span class="text-danger">*</span></label>
                                                        <input type="file" class="form-control"
                                                            name="event_image" id="tImage"
                                                            required
                                                            placeholder="Event Image"
                                                            v-on:change="onEventImage" />
                                                    </div>
                                                   
                                                   <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="end_date">Event Ticket Silver Price: <span class="text-danger">*</span></label>
                                                                <input type="number" class="form-control validate[required]" name="event_tickets[][ticket_price]"
                                                                    id="end_date" placeholder="Ticket Price" v-model="event_tickets[0].ticket_price" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Qty:</label>
                                                                <input type="number" id="qty" name="event_tickets[][qty]" class="form-control" placeholder="Enter Quantity" v-model="event_tickets[0].qty" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="end_date">Event Ticket Gold Price: <span class="text-danger">*</span></label>
                                                                <input type="number" class="form-control validate[required]" name="event_tickets[][ticket_price]"
                                                                    id="end_date" placeholder="Ticket Price" v-model="event_tickets[1].ticket_price" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Qty:</label>
                                                                <input type="number" id="qty" name="event_tickets[][qty]" class="form-control" placeholder="Enter Quantity"
                                                                v-model="event_tickets[1].qty" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="end_date">Event Ticket Platinum Price: <span class="text-danger">*</span></label>
                                                                <input type="number" class="form-control validate[required]" name="event_tickets[][ticket_price]"
                                                                    id="end_date" placeholder="Ticket Price"  v-model="event_tickets[2].ticket_price" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Qty:</label>
                                                                <input type="number" id="qty" name="event_tickets[][qty]" class="form-control" placeholder="Enter Quantity"
                                                                v-model="event_tickets[2].qty"
                                                                />
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
                                                Add Event
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
    import {
        _ADD_EVENTS,
        ERROR_SOMETHING_WENT_WRONG
    } from "../../config/constants";
    import api from "../../http-common";
    export default {
        name: 'AddEvent',
        data() {
            return {
                isLoading: false,
                btnDisabled: false,
                ticketTypes:[],
                event: {
                    'event_title' : "",
                    'event_description' : "",
                    'event_image' : "",
                    'event_location': "",
                    "event_start_date" : "",
                    "event_start_time": "",
                    "event_end_date": "",
                    "event_end_time": ""
                },
                event_tickets : [
                    {
                        ticket_type_id: 1,
                        ticket_price: 1,
                        qty:1
                    },
                    {
                        ticket_type_id: 2,
                        ticket_price: 1,
                        qty:1
                    },
                    {
                        ticket_type_id: 3,
                        ticket_price: 1,
                        qty:1
                    },
                ],
            }
        },
        methods: {
            async addEvent() {
                console.log(this.event_tickets);
                this.btnDisabled = true;
                let formData = new FormData();
                formData.append('event_title',this.event.event_title);
                formData.append('event_description',this.event.event_description);
                formData.append('event_start_date',this.event.event_start_date);
                formData.append('event_start_time',this.event.event_start_time);
                formData.append('event_end_date',this.event.event_end_date);
                formData.append('event_end_time',this.event.event_end_time);
                formData.append('event_location',this.event.event_location);
                formData.append('event_avatar',this.event.event_image);
                let i = 0;
                this.event_tickets.forEach(ticket => {
                     formData.append('event_tickets['+i+'][ticket_type_id]',ticket.ticket_type_id);
                     formData.append('event_tickets['+i+'][ticket_price]',ticket.ticket_price);
                     formData.append('event_tickets['+i+'][qty]',ticket.qty);
                     i++;
                });
                const response = await api.execute(_ADD_EVENTS,_ADD_EVENTS.route,formData);
                if (response && response.success == 1) {
                    this.$toast.success("Event added successfully");
                    window.location.href = "/events";
                } else if (response && response.success == 0) {
                    this.btnDisabled = false;
                    this.$toast.error(response.message);
                } else {
                    this.btnDisabled = false;
                    this.$toast.error(ERROR_SOMETHING_WENT_WRONG);
                }
            },
            onEventImage(e){
                this.event.event_image = e.target.files[0];
            },
        },
        mounted() {
           
        }
    }
</script>
