<script setup>
import { ref, onMounted, defineProps, computed } from 'vue';

import Layout from '@/Layouts/Layout.vue';
import Card from '@/Components/Card.vue';
import ModalComponent from '@/Components/ModalComponent.vue';
import Barchart from '@/Components/Barchart.vue';

const modal = ref('')
const chartData = ref({
  datasets: {
    data: null
  }
})

onMounted(() => {

  chartData.value.datasets.data = props.totalSales.map((item) => {
    const chartData = {}
    chartData.x = item.id
    chartData.y = item.amount
    return chartData
  })

})


const sales = computed(() => {
  return props.totalSales.reduce((acc, value) => {
    return (acc + value.amount)
  }, 0)
})

const props = defineProps({
  totalProducts: Number,
  totalOrders: Number,
  totalSales: Array,
  salesData: Object
})


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
            <p class="ms-2">{{ sales.toFixed(2) }} Tsh</p>
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
          <Barchart :chartData="chartData" :salesData="salesData" />
        </div>
      </div>

    </div>
  </Layout>
</template>


<style>

.card.product {
  background-color: rgb(148, 93, 219);
}
.content .card.product .card-header {
  background-color: rgb(91, 38, 160);
}
.card.sales {
  background-color: rgb(83, 177, 83);
}
.content .card.sales .card-header {
  background-color: rgb(19, 131, 19);
}
.card.sales-graph {
  background-color: rgb(162, 202, 162);
}
.content .card.sales-graph .card-header {
  background-color: rgb(29, 128, 29);
}
.card.customer {
  background-color: rgb(73, 83, 219);
}
.content .card.customer .card-header {
  background-color: rgb(32, 54, 182);
}
.card.orders {
  background-color: rgba(194, 216, 67, 0.767);
}
.content .card.orders .card-header {
  background-color: rgb(126, 128, 26);
}


</style>