

<script>
import { router } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'
import { Popover, Modal, Toast } from 'bootstrap';
import Table from '../../Components/Table.vue';
import Layout from '../../Layouts/Layout.vue';
import Card from '../../Components/Card.vue'
import ModalComponent from '../../Components/ModalComponent.vue';
import Pagination from '../../Components/Pagination.vue';
export default {
  components: {
    Layout,
    Card,
    Table,
    ModalComponent,
    Link,
    Pagination
  },
  data() {
    return {
      modal: '',
      closeIt: true,
      form:{
        _method: 'PUT',
        id: null,
        name: null,
        quantity: null,
        price: null,
        description: null,
        image: null,
        status: 'unverified'}
      ,
      title: '',
      submitButton: '',
      searchData: ''

    };
  },
  props: {
    products: Object
  },
  mounted() {
    Array.from(document.querySelectorAll('button[data-bs-toggle="popover"]')).forEach(popoverNode => new Popover(popoverNode))
    this.modal = new Modal(document.getElementById('modal'))
  },

  methods: {
    formState(id, name, quantity, price, description) {
      this.form.id = id
      this.form.name = name,
        this.form.quantity = quantity,
        this.form.price = price,
        this.form.description = description
    },
    showModal(data) {
      if (data == 'add') {
        this.modal.toggle()
        this.title = "ADD PRODUCT"
        this.submitButton = "ADD"
      } else {
        this.modal.toggle()
        this.title = "UPDATE PRODUCT"
        this.submitButton = "UPDATE"
        this.formState(data.id, data.name, data.quantity, data.price, data.description)
      }
    },
    submitSuccess(message) {
      this.$swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.onmouseenter = this.$swal.stopTimer;
          toast.onmouseleave = this.$swal.resumeTimer;
        }
      }).fire({
        icon: 'success',
        title: 'Product ' + message + ' success'
      })
    },

    submitError(message) {
      this.$swal({
        title: "Oops Error !!!",
        text: "Something went wrong! " + message,
        icon: "error"
      })
    }

    ,
    submit(data) {
      if (data == null) {
        this.form._method = 'POST'
       router.post('/admin/product',this.form, {
          onSuccess: () => {
            this.modal.toggle(),
              this.submitSuccess('Added')
          },
          onError: () => {
            this.submitError('It seems like Product already exists!')
          },
        })


      } else {
        router.post(`/admin/product/${data}`, this.form, {
          image: this.form.image,
          
          onSuccess: () => {
            this.modal.toggle(),
              this.formState(null, null, null, null, null)
            this.submitSuccess('Updated')
          },
          onError: () => {
            this.submitError('')
          },
        })
      }
    }
    ,

    remove(id) {
      this.$swal({
        title: "Are you sure !!!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "YES"
      }).then((result) => {
        if (result.isConfirmed) {
          router.delete(`/admin/product/${id}`, {
            onSuccess: () => {
              this.submitSuccess('Deleted')
            },
            onError: () => {
              this.submitError('')
            }
          })
        }
      })
    },
    search(searchData) {
      router.get(`/admin/product/?search=${searchData}`)
    },
  },
}
</script>


<template>
  <Layout>

    <ModalComponent>
      <form class="w-100" @submit.prevent="submit(form.id)">

        <h1 class="text-center pt-2 ">{{ title }}</h1>

        <div class="mb-3">
          <label for="name" class="form-label">Product Name</label>
          <input id="name" v-model="form.name" type="text" class="form-control" name="name"
            placeholder="Enter product name...." required />
        </div>
        <div class="mb-3">
          <label for="quantity" class="form-label">Product Quantity</label>
          <input id="quantity" v-model="form.quantity" type="number" class="form-control" name="quantity"
            placeholder="Enter product quantity...."  onkeypress="return event.charCode>=48" min="1" required />
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Product Price</label>
          <input id="price" v-model="form.price" type="number" step="0.01" min="1" class="form-control" name="price"
            placeholder="Enter product price...." required />
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Product Description</label>
          <textarea id="description" v-model="form.description" type="text" row="2" class="form-control"
            name="description" placeholder="Enter product description...." required></textarea>
        </div>
        <div class="mb-3">
          <label for="image" class="form-label">Product Image</label>
          <input id="image" @input="form.image = $event.target.files[0]" type="file" row="2" class="form-control"
            name="image"/>
        </div>
        <input id="status" type="hidden" name="status" value="unverified">
        <progress v-if="form.progress" :value="form.progress.percentage" max="100">{{ form.progress.percentage }}</progress>
        <button type="submit" class="btn btn-primary w-100" name="submit">{{ submitButton }}</button>
      </form>
    </ModalComponent>

    <div class="row ">

      <div class="col">
        <Card class="">
          <template v-slot:head>
            <div class="d-flex justify-content-between align-item-center">
              <div class="my-auto">PRODUCTS</div>
              <div>
                <form @submit.prevent="search(searchData)">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for product....." name="search"
                      v-model="searchData">
                    <button class="btn btn-success" type="submit">Search</button>
                  </div>
                </form>


              </div><button @click="showModal('add')" class="btn btn-success px-2">
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
                <tr v-show="products.length == 0" class="text-center w-100">
                  <td colspan="5">No Product Exist</td>
                </tr>
                <tr v-for="(product, index) in products.data " :key="product.id">
                  <td>{{ index +1 }}</td>
                  <td>{{ product.name.toUpperCase() }} </td>
                  <td>{{ product.quantity }}</td>
                  <td>{{ product.price }} Tsh</td>
                  <td class="d-flex justify-content-center gap-2">
                    <button @click="remove(product.id)" class="btn btn-danger" data-bs-toggle="popover"
                      data-bs-trigger="hover" data-bs-placement="bottom" data-bs-title="Delete"><i
                        class="bi bi-trash"></i></button>
                    <button @click="showModal(product)" class="btn btn-primary" data-bs-toggle="popover"
                      data-bs-trigger="hover" data-bs-placement="bottom" data-bs-title="Update">
                      <i class="bi bi-arrow-repeat"></i></button>
                  </td>
                </tr>

              </template>

            </Table>
          </template>
          <template v-slot:footer>

            <!-- <Pagination :links="products.links" /> -->

          </template>


        </Card>
      </div>
    </div>
  </Layout>
</template>




