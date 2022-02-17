<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User Registration Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                               <a href="#">User</a>
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
                                <h3 class="card-title">Add User</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div v-if="isLoading">
                                    <div class="text-center"><div class="fa-3x"><i class="fas fa-sync fa-spin"></i></div></div>
                                </div>
                                <div v-else>
                                    <form id="form1" role="form" method="post" @submit.prevent="addUser" enctype="multipart/form-data">
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="full_name">Full Name<span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control"
                                                            name="full_name" id="full_name"
                                                            required
                                                            minlength="3"
                                                            maxlength="255"
                                                            placeholder="Full Name"
                                                            v-model="user.full_name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email Address<span class="text-danger">*</span></label>
                                                       <input type="text" class="form-control"
                                                            name="email" id="email"
                                                            required
                                                            minlength="3"
                                                            maxlength="255"
                                                            placeholder="Email Address"
                                                            v-model="user.email">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer">
                                            <button class="btn btn-primary" type="submit" :disabled="btnDisabled ? true : false">
                                                <div class="fa-2x" v-if="btnDisabled"><i class="fas fa-sync fa-spin"></i></div>
                                                Add User
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
        _ADD_USER,
        ERROR_SOMETHING_WENT_WRONG
    } from "../../config/constants";
    import api from "../../http-common";
    export default {
        name: 'AddUser',
        data() {
            return {
                isLoading: false,
                btnDisabled: false,
                ticketTypes:[],
                user: {
                    full_name:"",
                    email: ""
                },
            }
        },
        methods: {
            async addUser() {
                this.btnDisabled = true;
                let formData = new FormData();
                formData.append('full_name',this.user.full_name);
                formData.append('email',this.user.email);
                const response = await api.execute(_ADD_USER,_ADD_USER.route,formData);
                if (response && response.success == 1) {
                    this.$toast.success("User added successfully");
                    window.location.href = "/users";
                } else if (response && response.success == 0) {
                    this.btnDisabled = false;
                    this.$toast.error(response.message);
                } else {
                    this.btnDisabled = false;
                    this.$toast.error(ERROR_SOMETHING_WENT_WRONG);
                }
            },
        },
    }
</script>
