<template>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard <i class="fas fa-sync-alt" @click="getDashboard()" style="cursor: pointer;"></i></li>
                </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row" v-if="isLoading">
                 <div class="col-12">
                    <div class="text-center"><div class="fa-3x"><i class="fas fa-sync fa-spin"></i></div></div>
                </div>
            </div>
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box bg-default">
                        <span class="info-box-icon"><i class="fas fa-calendar"></i></span>
                        <div class="info-box-content">
                            <router-link class="nav-link" to="/events">
                                <span class="info-box-text">All Events</span>
                                <span class="info-box-number total-orders">{{ dashboardData.totalEvents }}</span>
                            </router-link>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box bg-default">
                        <span class="info-box-icon"><i class="fas fa-calendar"></i></span>
                        <div class="info-box-content">
                            <router-link class="nav-link" to="/events?type=scheduled">
                                <span class="info-box-text">Scheduled Events</span>
                                <span class="info-box-number active-orders">{{ dashboardData.scheduledEvents }}</span>
                            </router-link>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box bg-default">
                        <span class="info-box-icon"><i class="fas fa-calendar"></i></span>
                        <div class="info-box-content">
                            <router-link class="nav-link" to="/events?type=completed">
                                <span class="info-box-text">Completed Events</span>
                                <span class="info-box-number active-orders">{{ dashboardData.completedEvents }}</span>
                            </router-link>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                 <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>
                
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box bg-default">
                        <span class="info-box-icon"><i class="fas fa-dollar-sign"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Revenue</span>
                            <span class="info-box-number complete-orders">{{ dashboardData.totalRevenue }}</span>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                 <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box bg-default">
                        <span class="info-box-icon"><i class="fas fa-dollar-sign"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Today Revenue</span>
                            <span class="info-box-number complete-orders">{{ dashboardData.todayRevenue }}</span>
                        </div>
                    </div>
                </div>
                <!-- /.col -->

                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box bg-default">
                        <span class="info-box-icon"><i class="fas fa-user"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Users</span>
                            <span class="info-box-number total-earnings">{{ dashboardData.total_users }}</span>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-5 col-sm-12">
                   <EventStateChart :total-event="dashboardData.totalEvents" :completed-event="dashboardData.completedEvents" :scheduled-event="dashboardData.scheduledEvents" :key="componentKey"/>
                </div>
                <div class="col-md-7 col-sm-12">
                    <SalesRevenueChart :current-revenue="dashboardData.currentRevenue" :sum-revenue="dashboardData.sumRevenue" :key="componentKey"/>
                </div>
            </div>
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
    </div>
</template>
<script>
import { _DASHBOARD,ERROR_SOMETHING_WENT_WRONG } from "../config/constants";
import api from "../http-common";
import EventStateChart from '@/components/EventStateChart';
import SalesRevenueChart from '@/components/SalesRevenueChart'
//mport chartComp from '@/components/chartComp';
export default {
    name: 'AdminDashboard',
    components : {EventStateChart, SalesRevenueChart},
    data() {
        return {
            isLoading:true,
            componentKey: 0,
            dashboardData : {
                totalEvents: 0,
                completedEvents: 0,
                scheduledEvents: 0,
                total_users: 0,
                totalRevenue: 0,
                todayRevenue: 0,
                sumRevenue: 0,
                currentRevenue: [0,0,0,0,0,0,0,0,0,0,0,0],
            }
        }
    },
    created(){
        this.getDashboard();
    },
    methods : {
        async getDashboard() {
            this.isLoading = true;
            const response = await api.execute(_DASHBOARD, _DASHBOARD.route);
            if (response && response.success == 1) {
                this.isLoading = false;
                this.dashboardData = response.data;
                this.componentKey++;
            } else if (response && response.success == 0) {
                this.$toast.error(response.message);
            } else {
                this.$toast.error(ERROR_SOMETHING_WENT_WRONG);
            }
        },
    },
    mounted(){
    
    }
}
</script>
