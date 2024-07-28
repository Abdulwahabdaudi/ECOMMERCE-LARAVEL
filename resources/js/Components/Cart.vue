<script setup>
import { router } from '@inertiajs/vue3';
import { defineProps, computed, ref } from 'vue';
import { submitSuccess, submitError } from '@/Alert';


import Card from './Card.vue'
import Table from './Table.vue'

const props = defineProps({
    cartProducts: Array,
})

const orderData = ref({
    totalPrice: null,
})
const cartData = ref({
    product_id: null,
    quantity: null
})

const cartTotal = computed(() => {
    return props.cartProducts.reduce((acc, curr) => {
        return acc + curr.pivot.price
    }, 0);
})

const createOrder = () => {
    orderData.value.totalPrice = cartTotal
    router.post('/admin/order', orderData.value, {
        onSuccess: () => {
            submitSuccess('Order')
        },
        onError: (error) => {
            submitError(error.message)
        },
    })

}

const emptyCart = () => {
    router.delete('/admin/pos/empty', {
        onSuccess: () => {
            submitSuccess('Cart Cleared')
        },
        onError: () => {
            submitError('')
        },
    })
}

const changeItemQuantity = (value1, value2, index) => {
    const Changes = (cartData) => {
        router.post('/admin/pos/change', cartData, {
            onSuccess: () => {
                submitSuccess('Quantity Changed')
            },
            onError: (error) => {
                submitError(error.message)
            },
        })
    }

    if (!value1 || value1 == 0) {

        cartData.value.quantity = cartProducts[index].pivot.quantity = 1
        cartData.value.product_id = value2
        Changes(cartData.value)
    } else {
        cartData.value.product_id = value2
        cartData.value.quantity = value1
        Changes(cartData.value)
    }
}


const removeCartItem = (data) => {
    router.delete(`/admin/pos/delete/${data}`, {
        onSuccess: () => {
            submitSuccess('Removed')
        },
        onError: () => {
            submitError('')
        },
    })
}

</script>


<template>
    <div class="col-4">
        <Card class="cart">
            <template v-slot:head>
                CART
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
                        <tr v-show="cartProducts.length == 0" class="text-center w-100">
                            <td colspan="5">No Product in the cart</td>
                        </tr>
                        <tr v-for="res, index in cartProducts" :key="cartProducts.id">
                            <td>{{ index + 1 }}</td>
                            <td class="">{{ res.pivot.name }}</td>
                            <td class="cart_quantity ">
                                <div class="">
                                    <form @submit.prevent>
                                        <input class="form-control form-control-sm" type="number" min="1"
                                            onkeypress="return event.charCode>=48 event.charCode=13"
                                            v-model="res.pivot.quantity"
                                            @change="changeItemQuantity(res.pivot.quantity, res.id, index)">
                                    </form>
                                </div>

                            </td>
                            <td>{{ (res.price * res.pivot.quantity).toFixed(2) }}Tsh</td>
                            <td class="d-flex justify-content-center gap-2">
                                <button class="btn btn-danger" data-bs-toggle="popover" data-bs-trigger="hover"
                                    data-bs-placement="bottom" data-bs-title="Delete"
                                    @click="removeCartItem(res.pivot.product_id)"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>


                    </template>
                </Table>
            </template>
            <template v-slot:footer>
                <div class="overflow-auto ">
                    <div class=" m-2 ">
                        <button class="btn btn-secondary w-100">TOTAL PRICE: <h4>{{ cartTotal.toFixed(2) }} TSH
                            </h4>
                        </button>
                    </div>
                    <div class="d-flex justify-content-between m-2 gap-2 ">
                        <button class="btn btn-success" @click="createOrder()">ADD ORDER</button>
                        <button class="btn btn-danger" @click="emptyCart()">CLEAR ALL</button>
                    </div>
                </div>

            </template>
        </Card>
    </div>
</template>