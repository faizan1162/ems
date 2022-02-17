<template>
     <div class="card">
        <div class="card-header">
            <h3 class="card-title">Revenue 2022</h3>

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
            <div class="chart">
                <canvas id="barChart"
                        style="min-height: 380px; height: 380px; max-height: 380px; max-width: 100%;"></canvas>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer text-center">
            <a href="#">View All Sales</a>
        </div>
    </div>
</template>
<script>
import { Chart } from "chart.js";
export default {
    name: 'SalesRevenueChart',
    props: ['currentRevenue','sumRevenue'],
    methods : {
       revenueBarChart(rev,sR) {
            var areaChartData = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [
                    {
                        label: 'Revenue: $'+sR,
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [rev]
                    }
                ]
            }
            // var animal = {
            //     spicies:"birds"
            // }
            // var birds = Object.create(animal);
            // console.log(birds.spicies);
            var barChartCanvas =  document.getElementById('barChart').getContext('2d');
            var barChartData = window.jQuery.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            //var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp0
            //barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            var barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            });
            console.log(barChart);
        }
    },
    mounted(){
        console.log(this.currentRevenue);
        this.revenueBarChart(this.currentRevenue,this.sumRevenue);
    }
}
</script>