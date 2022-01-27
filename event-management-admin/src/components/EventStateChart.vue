<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Events State</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="chart-responsive">
                        <canvas id="pieChart" height=""></canvas>
                    </div>
                    <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <ul class="chart-legend clearfix">
                        <li><i class="far fa-circle text-primary"></i> Total</li>
                        <li><i class="far fa-circle text-success"></i> Complete</li>
                        <li><i class="far fa-circle text-warning"></i> Scheduled</li>
                    </ul>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer text-center">
            <router-link class="nav-link" to="/events">View All Events</router-link>
        </div>
    </div>
</template>
<script>
import { Chart } from "chart.js";
export default {
    name: 'EventStateChart',
    props: ['totalEvent','completedEvent','scheduledEvent'],
    methods : {
        eventDonutChart(total, complete, schedule) {
            var pieChartCanvas = document.getElementById('pieChart').getContext('2d');
            var pieData = {
                labels: [
                    'Total Events',
                    'Complete Events',
                    'Schedule Events',
                ],
                datasets: [
                    {
                        data: [total, complete, schedule],
                        backgroundColor: ['#007bff', '#28a745', '#ffc107'],
                    }
                ]
            }
            var pieOptions = {
                legend: {
                    display: false
                }
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var pieChart = new Chart(pieChartCanvas, {
                type: 'doughnut',
                data: pieData,
                options: pieOptions
            })
            console.log(pieChart);
        }
    },
    mounted(){
        console.log(this.totalEvent);
        this.eventDonutChart(this.totalEvent,this.completedEvent,this.scheduledEvent);
    }
}
</script>