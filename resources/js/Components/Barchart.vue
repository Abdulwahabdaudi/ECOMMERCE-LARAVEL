<template>
  <Line :data="chartData" :options="chartOptions" />
</template>
  
<script>
import { Line } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, LineElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, LineElement, CategoryScale, LinearScale)

export default {
  name: 'BarChart',
  components: { Line },
  props: {
    salesData: Array

  },

  data() {
    return {
      //   chartData: {
      //     labels: this.salesData.map((row) => row.day),
      //     datasets:
      //       [
      //         {
      //           color: '#fff',
      //           label: 'sales',
      //           backgroundColor: (ctx) => {
      //             const canvas = ctx.chart.ctx
      //             const gradient = canvas.createLinearGradient(0, 0, 0, 160);
      // gradient.addColorStop(0, 'rgba(75, 192, 192, 0.8)');
      // gradient.addColorStop(1, 'rgba(75, 192, 192, 0.1)');
      //     return gradient
      //           },
      //           data: this.salesData.map((row) => row.amount),
      //           borderColor: "#47b784",
      //           borderWidth: 2,
      //           fill: true


      //         }
      //       ]
      //   },


    }
  },
  computed: {
    chartData() {
      return {
        labels: this.salesData.map((row) => row.day),
        datasets:
          [
            {
              color: '#fff',
              label: 'sales',
              backgroundColor: (ctx) => {
                const canvas = ctx.chart.ctx
                const gradient = canvas.createLinearGradient(0, 0, 0, 600);
                gradient.addColorStop(0, 'rgba(75, 192, 192, 1)');
                gradient.addColorStop(0.5, 'rgba(75, 192, 192, 0.5)');
                gradient.addColorStop(1, 'rgba(75, 192, 192, 0.1)');
                return gradient
              },
              data: this.salesData.map((row) => row.amount),
              borderColor: "#47b784",
              borderWidth: 2,
              fill: true,
              tension: 0.3

            }
          ]
      }

    },
    chartOptions() {
      return {
        responsive: true,
        color: '#fff',
        legend: {
          labels: {
          }
        },
        scales: {
          y:
          {
            ticks: {
              color: '#fff',
              beginAtZero: true,
            }
          }
          ,
          x:
          {
            ticks: {
              color: '#fff',
              beginAtZero: true,
            }
          }
          ,
        }

      }
    }
  },
  
}
</script>
  