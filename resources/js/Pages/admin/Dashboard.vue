<script>
import { Popover, Modal } from 'bootstrap';

//import Table from '../../components/Table.vue';
import Layout from '../../Layouts/Layout.vue';
import Card from '../../Components/Card.vue';
import ModalComponent from '../../Components/ModalComponent.vue';
import Barchart from '../../Components/Barchart.vue';
export default {
  components: {
    Layout,
    Card,
    // Table,
    ModalComponent,
    Barchart
  },
  data() {
    return {
      modal: '',
      chartData:{
        datasets: {
         data: null
        } 
      },
      
    };
  },
  mounted() {
    Array.from(document.querySelectorAll('button[data-bs-toggle="popover"]')).forEach(popoverNode => new Popover(popoverNode))
    this.modal = new Modal(document.getElementById('modal'))
    console.log(this.salesData);
   this.chartData.datasets.data = this.totalSales.map((item) => {
      const chartData = {}
      chartData.x = item.id
      chartData.y = item.amount
      return chartData
    })
 
  },
  methods: {
    showModal() {
      this.modal.show()
    },
    sales() {
      return this.totalSales.reduce((acc, value) => {
        return (acc + value.amount)
      }, 0)
    }
  },
  props: {
    totalProducts: Number,
    totalOrders: Number,
    totalSales:Array,
    salesData: Object
  },

}
</script>

<template>
  <Layout>

    <ModalComponent />
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4">
      <div class="col">
        <Card class="product">
          <template v-slot:head>
            PRODUCTS
          </template>
          <template v-slot:body>
            <p class="ms-2">{{ totalProducts }}</p>
          </template>
        </Card>
      </div>
      <div class="col">
        <Card class="sales">
          <template v-slot:head>
            SALES
          </template>
          <template v-slot:body>
            <p class="ms-2">{{ sales().toFixed(2) }} Tsh</p>
          </template>
        </Card>
      </div>
      <div class="col">
        <Card class="customer">
          <template v-slot:head>
            CUSTOMERS
          </template>
          <template v-slot:body>
            <p class="ms-2">20</p>
          </template>
        </Card>
      </div>
      <div class="col">
        <Card class="orders">
          <template v-slot:head>
            ORDERS
          </template>
          <template v-slot:body>
            <p class="ms-2">{{ totalOrders }}</p>
          </template>
        </Card>
      </div>
    </div>





    <div class="row m-2">

     <div class="card ">
         <div class="col">
        <Barchart :chartData="chartData" :salesData="salesData"/>
      </div>
     </div>
   



    </div>
  </Layout>
</template>




