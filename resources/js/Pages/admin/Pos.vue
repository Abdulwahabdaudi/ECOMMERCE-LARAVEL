<script setup>
import { router } from '@inertiajs/vue3'
import { ref, defineProps } from 'vue';
import { submitSuccess, submitError } from '@/Alert';

import Layout from '@/Layouts/Layout.vue';
import Card from '@/Components/Card.vue'
import Cart from '@/Components/Cart.vue';


const itemToCart = ref({
    id: null
})

const props = defineProps({
    products: Object,
    customers: Object,
    cartProducts: {
        type: Array,
        required: true,
    },
    message: String,
})


const submit = (data) => {
    itemToCart.value.id = data
    router.post('/admin/pos', itemToCart.value, {
        onSuccess: () => {
            submitSuccess('Added To Cart')
        },
        onError: (error) => {
            submitError(error.message)
        },
    })
}


</script>

<template>
    <Layout>
        <div class="row">
            <div class="col-8">
                <Card class="cart">
                    <template v-slot:head>
                        PRODUCT
                    </template>
                    <template v-slot:body>
                        <div class="row row-cols-lg-4 g-1 m-1 ">

                            <div class="col " v-for="product in props.products" :key="product.id">
                                <Card class="cart h-100 " @click="submit(product.id)">
                                    <template v-slot:head>
                                        <h5 class="text-truncate">{{ product.name }}</h5>
                                    </template>
                                    <template v-slot:body>

                                        <img class="d-flex w-50  border border-primary mx-auto my-2"
                                            :src="!product.image ? '/logo.jpg' : `/storage/${product.image}`"
                                            alt="image">

                                        <h5 class="price text-center text-truncate">{{ product.price }} TSH</h5>
                                        <button class="d-flex btn btn-primary mx-auto mb-2">ADD
                                            TO CART</button>
                                    </template>
                                </Card>
                            </div>

                        </div>
                    </template>
                </Card>
            </div>


            <Cart :cartProducts="props.cartProducts"
            :customers="customers"
            />

        </div>
    </Layout>
</template>

<style>
.cart img {
    height: 80px;
    width: 30px;
    border-radius: 1rem;
}
</style>