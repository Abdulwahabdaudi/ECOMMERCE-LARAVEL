<script>
import { Popover , Modal} from 'bootstrap';
import Table from '../../components/Table.vue';
import Layout from '../../Layouts/Layout.vue';
import Card from '../../Components/Card.vue'
import ModalComponent from '../../Components/ModalComponent.vue';
export default {
  components: {
    Layout,
    Card,
    Table,
    ModalComponent
  },
  data() {
        return {
            modal:''
        };
    },
  mounted(){
    Array.from(document.querySelectorAll('button[data-bs-toggle="popover"]')).forEach(popoverNode =>new Popover(popoverNode))
    this.modal = new Modal(document.getElementById('modal'))

  },
    methods: {
        showModal() {
               this.modal.show()            
            }
    },


}
</script>

<template>
  <Layout>

    <ModalComponent/>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4">
      <div class="col">
        <Card class="product">
          <template v-slot:head>
            PROODUCTS
          </template>
          <template v-slot:body>
            <p class="">200</p>
          </template>
        </Card>
      </div>
      <div class="col">
        <Card class="sales">
          <template v-slot:head>
            SALES
          </template>
          <template v-slot:body>
            <p class="">200</p>
          </template>
        </Card>
      </div>
      <div class="col">
        <Card class="customer">
          <template v-slot:head>
            CUSTOMERS
          </template>
          <template v-slot:body>
            <p class="">200</p>
          </template>
        </Card>
      </div>
      <div class="col">
        <Card class="orders">
          <template v-slot:head>
            ORDERS
          </template>
          <template v-slot:body>
            <p class="">200</p>
          </template>
        </Card>
      </div>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-2">
     
      <div class="col">
        <Card class="orders">
          <template v-slot:head>
            <div class="d-flex justify-content-between align-item-center">
              <div class="my-auto">PRODUCTS</div> <button class="btn btn-success px-2">
                <i class="bi bi-plus-lg me-2 "></i>ADD</button>
            </div>
          </template>
          <template v-slot:body>
            <Table>
              <template v-slot:head>

                <td>S/N</td>
                <td>Name</td>
                <td>Quantity</td>
                <td>Price</td>
                <td>Action</td>
              </template>
              <template v-slot:body>
                <tr>
                    <td></td>
                <td>Lorem </td>
                <td></td>
                <td>Tsh</td>
                <td class="d-flex justify-content-center gap-2">
                  <button class="btn btn-danger"
                  data-bs-toggle="popover"
              data-bs-trigger="hover"
              data-bs-placement="bottom"
              data-bs-title="Delete"
                  ><i class="bi bi-trash"></i></button>
                  <button @click="showModal" class="btn btn-primary"
                  data-bs-toggle="popover"
              data-bs-trigger="hover"
              data-bs-placement="bottom"
              data-bs-title="Update">
                  <i class="bi bi-arrow-repeat"></i></button>
                </td>
                </tr>
              

              </template>
            </Table>
          </template>
        </Card>
      </div>
      <div class="col">
        <Card class="orders">
          <template v-slot:head>
            <div class="d-flex justify-content-between align-item-center">
              <div class="my-auto">PRODUCTS</div> <button class="btn btn-success px-2">
                <i class="bi bi-plus-lg me-2 "></i>ADD</button>
            </div>
          </template>
          <template v-slot:body>
            <Table>
              <template v-slot:head>

                <tr>
                    <td></td>
                <td>Lorem </td>
                <td></td>
                <td>Tsh</td>
                <td class="d-flex justify-content-center gap-2">
                  <button class="btn btn-danger"
                  data-bs-toggle="popover"
              data-bs-trigger="hover"
              data-bs-placement="bottom"
              data-bs-title="Delete"
                  ><i class="bi bi-trash"></i></button>
                  <button @click="showModal" class="btn btn-primary"
                  data-bs-toggle="popover"
              data-bs-trigger="hover"
              data-bs-placement="bottom"
              data-bs-title="Update">
                  <i class="bi bi-arrow-repeat"></i></button>
                </td>
                </tr>
              </template>
            </Table>
          </template>
        </Card>
      </div>

   


    </div>
  </Layout>
</template>




