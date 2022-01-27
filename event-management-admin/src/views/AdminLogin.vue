<template>
    <div id="login-page">
        <div class="authentication-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 p-0 card-left">
                        <div class="card bg-primary">
                            <div class="svg-icon">
                                <img :src="siteLogo" class="Img-fluid" />
                            </div>
                            <div tabindex="-1" style="width: 100%; display: inline-block" class="slik-content">
                                <div>
                                    <h3>Welcome to {{ appName }} Admin</h3>
                                    <p>
                                        We strive to provide our customers with
                                        the best prices, service, and
                                        entertainment value all in one.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 p-0 card-right">
                        <div class="card tab2-card">
                            <div class="card-body">
                                <div>
                                    <div class="react-tabs" data-tabs="true">
                                        <ul class="nav nav-tabs tab-coupon" role="tablist">
                                            <li class="
                                                    nav-link
                                                    react-tab-selected
                                                " role="tab" id="login-tab" aria-selected="true" aria-disabled="false"
                                                aria-controls="react-tabs-0" tabindex="0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                                Login
                                            </li>
                                        </ul>
                                        <div class="login-tab" role="tabpanel">
                                            <form class="form-horizontal auth-form" method="post" @submit.prevent="loginAdmin">
                                                <div class="form-group">
                                                    <input type="email" v-model="email" class="form-control" placeholder="Email" id="exampleInputEmail1" />
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" v-model="password" class="form-control" placeholder="Password" />
                                                </div>
                                                <input type="hidden" v-model="tz" />
                                                <div class="form-button">
                                                    <button class="btn btn-primary" type="submit" :disabled="btnDisabled ? true : false">
                                                        <div class="fa-2x" v-if="btnDisabled"><i class="fas fa-sync fa-spin"></i></div>
                                                        LOGIN
                                                    </button>
                                                </div>
                                                <div class="form-group"><br>
                                                    <div>Email: admin@admin.com<br>Password: admin12345</div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="forgot-tab" role="tabpanel" style="display: none">
                                            <form class="form-horizontal auth-form" action="#" method="post">
                                                <div class="form-group">
                                                    <input type="email" name="email" class="
                                                            form-control
                                                            validate[required,custom[email]]
                                                        " placeholder="Enter Your Registered Email"
                                                        id="exampleInputEmail2" />
                                                </div>
                                                <div class="form-button">
                                                    <button class="btn btn-primary" type="submit">
                                                        SEND
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="Toastify"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { _LOGIN, ERROR_SOMETHING_WENT_WRONG } from '../config/constants';
    import api from "../http-common";
    import { mapActions, mapGetters } from "vuex";
    export default {
        name: "AdminLogin",
        data() {
            return {
                siteLogo : '/assets/logo.jpg',
                appName: "Event Management System",
                email: "",
                password: "",
                tz: Intl.DateTimeFormat().resolvedOptions().timeZone,
                btnDisabled: false,
            };
        },
        computed: {
            ...mapGetters("account", ["isLoggedIn"]),
        },
        methods: {
            ...mapActions("account", ["saveUser"]),
            async loginAdmin() {
                if (this.email != "" && this.password != "") {
                    this.btnDisabled = true;
                    let data = {
                        email: this.email,
                        password: this.password,
                    };
                    const response = await api.execute(_LOGIN, _LOGIN.route, data);
                    if (response && response.success == 1) {
                        this.saveUser(response.data);
                        this.$toast.success(response.message);
                        this.$router.push({ name: "AdminDashboard" });
                        window.location.href = '/dashboard';
                        
                    } else if (response && response.success == 0) {
                        this.$toast.error(response.message);
                        this.btnDisabled = false;
                    } else {
                        this.$toast.error(ERROR_SOMETHING_WENT_WRONG);
                        this.btnDisabled = false;
                    }
                } else {
                    this.$toast.error("Email and Password Required");
                }
            },
        },
        mounted(){
            if (this.isLoggedIn) {
                this.$router.push({ name: "AdminDashboard" });
            }
        }
    };

</script>
<style>
    .btn-primary {
        background-color: #091e2a !important;
        border-color: #091e2a !important;
    }

    .btn-primary:hover,
    .btn-primary:focus,
    .btn-primary:active,
    .btn-primary.active {
        background-color: #00b53a !important;
        border-color: #00b53a !important;
    }

    .authentication-box {
        min-width: 100vw;
        min-height: 100vh;
        width: auto;
        height: auto;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .authentication-box .container {
        max-width: 900px;
    }

    .authentication-box .container .bg-primary {
        padding: 50px;
        background-image: url("../assets/login-bg.png");
        background-position: center;
        box-shadow: 1px 5px 24px 0 rgb(255 128 132 / 80%);
    }

    .bg-primary {
        background-color: #00b53a !important;
        color: #ffffff;
    }

    .authentication-box .container .svg-icon {
        padding: 24px;
        margin: 0 auto;
        border: 2px dashed #ffffff;
        border-radius: 100%;
        height: 130px;
        width: 130px;
        margin-bottom: 40px;
    }

    .authentication-box .container .svg-icon img {
        width: 100%;
    }

    img {
        vertical-align: middle;
        border-style: none;
    }

    .authentication-box .slick-slider {
        margin-bottom: 30px;
    }

    .card-left {
        z-index: 1;
    }

    .authentication-box .container h3 {
        color: #ffffff;
        font-weight: 600;
        text-align: center;
        font-size: 24px;
        letter-spacing: 0.03em;
    }

    .authentication-box .container p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 15px;
        line-height: 2;
        text-align: center;
    }

    .authentication-box .row {
        align-items: center;
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        margin-bottom: 30px;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0px;
        transition: all 0.3s ease;
        letter-spacing: 0.5px;
        border-radius: 8px;
        box-shadow: 1px 5px 24px 0 rgb(68 102 242 / 5%);
    }

    .card .card-body {
        padding: 30px;
        background-color: transparent;
        flex: 1 1 auto;
    }

    .tab-coupon {
        margin-bottom: 30px;
    }

    .nav-tabs {
        border-bottom: 1px solid #dee2e6;
    }

    .nav {
        display: flex;
        flex-wrap: wrap;
        padding-left: 0;
        list-style: none;
    }

    .authentication-box .tab2-card .nav-tabs .nav-link {
        font-size: 18px;
        transition: 0.3s;
        cursor: pointer;
        border: 1px solid transparent;
        border-top-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
        display: block;
        padding: 0.5rem 1rem;
    }

    .react-tabs .nav-tabs .nav-link.react-tab-selected,
    .react-tabs .nav-tabs .nav-link:hover,
    .react-tabs .nav-tabs .nav-link:focus {
        border-color: transparent transparent transparent !important;
        border-bottom: 2px solid #00b53a !important;
        color: #00b53a;
    }

    .authentication-box .tab2-card .nav-tabs .nav-link svg {
        width: 20px;
        vertical-align: sub;
        margin-right: 5px;
    }

    .authentication-box .container .form-group {
        margin-bottom: 1.5rem;
    }

    .auth-form .form-control {
        border-radius: 25px;
        padding: 9px 25px;
        border: 1px solid #eaeaea;
    }

    .btn:not(:disabled):not(.disabled) {
        cursor: pointer;
    }

    .authentication-box .btn-primary {
        border-radius: 25px;
        margin-top: 12px;
        font-weight: 400;
        padding: 11px 45px;
    }

    .authentication-box .container p.fpsw {
        text-align: left;
        font-size: 16px;
    }

    p.fpsw a {
        color: #00b53a !important;
        font-style: italic;
    }

</style>
