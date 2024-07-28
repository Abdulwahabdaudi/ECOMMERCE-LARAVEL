<script setup>
import { onMounted, ref } from 'vue';
import Swal from 'sweetalert2'
import { router } from '@inertiajs/vue3'
import { Popover, Modal } from 'bootstrap';
import { submitSuccess, submitError } from '@/Alert';


import Table from '@/Components/Table.vue';
import Layout from '@/Layouts/Layout.vue';
import Card from '@/Components/Card.vue'
import ModalComponent from '@/Components/ModalComponent.vue';


const modal = ref('')
const form = ref({
  _method: 'PUT',
  id: null,
  name: null,
  quantity: null,
  price: null,
  description: null,
  image: null,
  status: 'unverified'
})

const title = ref('')
const submitButton = ref('')
const searchData = ref('')

const props = defineProps({
  products: Object
})

onMounted(() => {
  Array.from(document.querySelectorAll('button[data-bs-toggle="popover"]')).forEach(popoverNode =>
    new Popover(popoverNode)),
  modal.value = new Modal(document.getElementById('modal'))
})


const formState = (id, name, quantity, price, description) => {
  form.value.id = id
  form.value.name = name,
    form.value.quantity = quantity,
    form.value.price = price,
    form.value.description = description
}
const showModal = (data) => {
  if (data == 'add') {
    modal.value.toggle()
    title.value = "ADD PRODUCT"
    submitButton.value = "ADD"
  } else {
    modal.value.toggle()
    title.value = "UPDATE PRODUCT"
    submitButton.value = "UPDATE"
    formState(data.id, data.name, data.quantity, data.price, data.description)
  }
}


const submit = (data) => {
  if (data == null) {
    form.value._method = 'POST'
    router.post('/admin/product', form.value, {
      onSuccess: () => {
        modal.value.toggle(),
        submitSuccess('Added')
      },
      onError: () => {
        submitError('It seems like Product already exists!')
      },
    })
  } else {
    router.post(`/admin/product/${data}`, form.value, {
      image: form.value.image,

      onSuccess: () => {
        modal.value.toggle(),
         formState(null, null, null, null, null)
       submitSuccess('Updated')
      },
      onError: () => {
       submitError('')
      },
    })
  }
}


const remove = (id) => {
  Swal.fire({
    title: "Are you sure !!!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "YES"
  }).then((result) => {
    if (result.isConfirmed) {
      router.delete(`/admin/product/${id}`, {
        onSuccess: () => {
          submitSuccess('Deleted')
        },
        onError: () => {
          submitError('')
        }
      })
    }
  })
}

const search = (searchData) => {
  router.get(`/admin/product/?search=${searchData}`)
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
            placeholder="Enter product quantity...." onkeypress="return event.charCode>=48" min="1" required />
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
            name="image" />
        </div>
        <input id="status" type="hidden" name="status" value="unverified">
        <progress v-if="form.progress" :value="form.progress.percentage" max="100">{{ form.progress.percentage
          }}</progress>
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
                  <td>{{ index + 1 }}</td>
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

        </Card>
      </div>
    </div>
  </Layout>
</template>
