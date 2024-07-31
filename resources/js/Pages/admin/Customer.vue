<script setup>
import { onMounted, ref } from 'vue';
import Swal from 'sweetalert2'
import { router } from '@inertiajs/vue3'
import { Popover, Modal} from 'bootstrap';

import Table from '@/Components/Table.vue';
import Layout from '@/Layouts/Layout.vue';
import Card from '@/Components/Card.vue'
import ModalComponent from '@/Components/ModalComponent.vue';



const modal = ref('')
const form = ref({
  id: null,
  name: null,
  quantity: null,
  price: null,
  description: null,
  status: 'unverified'
})

const title = ref('')
const submitButton = ref('')

const props = defineProps({
  customers: Object
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

const submit = (data) => {
  if (data == null) {
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
    router.put(`/admin/product/${data}`, form.value, {
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
      router.delete(`/admin/customer/${id}`, {
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
        <input id="status" type="hidden" name="status" value="unverified">
        <button type="submit" class="btn btn-primary w-100" name="submit">{{ submitButton }}</button>
      </form>
    </ModalComponent>

    <div class="row ">

      <div class="col">
        <Card class="">
          <template v-slot:head>
            <div class="d-flex justify-content-between align-item-center">
              <div class="my-auto">CUSTOMERS</div>
              <div>
              </div>
            </div>
          </template>
          <template v-slot:body>
            <Table>
              <template v-slot:head>

                <td>S/N</td>
                <td>NAME</td>
                <td>PHONE</td>
                <td>EMAIL</td>
                <td>ACTION</td>
              </template>
              <template v-slot:body>
                <tr v-show="customers.length == 0" class="text-center w-100">
                  <td colspan="5">No Order Exist</td>
                </tr>
                <tr v-for="(customer, index) in customers " :key="customer.id">
                  <td>{{ index + 1 }}</td>
                  <td>{{ customer.name }}</td>
                  <td>{{ customer.phone }}</td>
                  <td>{{ customer.email }}</td>
                  <td class="d-flex justify-content-center gap-2">
                    <button @click="remove(customer.id)" class="btn btn-danger" data-bs-toggle="popover"
                      data-bs-trigger="hover" data-bs-placement="bottom" data-bs-title="Delete"><i
                        class="bi bi-trash"></i></button>
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
