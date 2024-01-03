<script>
import { router } from '@inertiajs/vue3'


import Layout from '../../Layouts/Layout.vue';
import Card from '../../Components/Card.vue'
import Table from '../../Components/Table.vue'

export default {
    data() {
        return {
            dataS: {
                id: null
            },
            cartData: {
                product_id: null,
                quantity: null
            },
            orderData: {
                totalPrice: null
            }
        }
    },
    components: {
        Layout,
        Card,
        Table
    },
    props: {
        products: Object,
        cartProducts: Array
    },
    mounted() {
        this.cartProducts
    },

    methods: {
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
                title: "Oops Error Something went wrong!!!",
                text: " " + message,
                icon: "error"
            })
        },

        submit(data) {
            this.dataS.id = data
            router.post('/admin/pos', this.dataS, {
                onSuccess: () => {
                    this.submitSuccess('Added To Cart')
                },
                onError: (error) => {
                    this.submitError(error.message)
                },
            })
        },
        remove(data) {
            router.delete(`/admin/pos/delete/${data}`, {
                onSuccess: () => {
                    this.submitSuccess('Removed')
                },
                onError: () => {
                    this.submitError('')
                },
            })
        },
        empty() {
            router.delete('/admin/pos/empty', {
                onSuccess: () => {
                    this.submitSuccess('Cart Cleared')
                },
                onError: () => {
                    this.submitError('')
                },
            })
        },

        change(value1, value2, index) {
            if (!value1 || value1 == 0) {

                this.cartData.quantity = this.cartProducts[index].pivot.quantity = 1
                this.cartData.product_id = value2

                router.post('/admin/pos/change', this.cartData, {
                    onSuccess: () => {
                        this.submitSuccess('Quantity Changed')
                    },
                    onError: (error) => {
                        this.submitError(error.message)
                    },
                })
            } else {
                this.cartData.product_id = value2
                this.cartData.quantity = value1
                router.post('/admin/pos/change', this.cartData, {
                    onSuccess: () => {
                        this.submitSuccess('Quantity Changed')
                    },
                    onError: (error) => {
                        this.submitError(error.message)
                    },
                })
            }



        },
        total() {

            return this.cartProducts.reduce((acc, curr) => {
                return acc + curr.pivot.price
            }, 0);


        },
        createOrder(){
            this.orderData.totalPrice = this.total().toFixed(2)
            console.log(this.totalPrice);
            router.post('/admin/order', this.orderData, {
                onSuccess: () => {
                    this.submitSuccess('Order')
                },
                onError: (error) => {
                    this.submitError(error.message)
                },
        })
    }
}
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
                        <div class="row row-cols-lg-4 ">

                            <div class="col " v-for="product in products" :key="product.id">
                                <Card class="cart">
                                    <template v-slot:head>
                                        <h5 class="">{{ product.name }}</h5>
                                    </template>
                                    <template v-slot:body>

                                        <img class="d-flex w-50 h-75 border border-primary border-3 mx-auto my-2"
                                            src="../../../../public/logo.jpg" alt="">

                                        <h5 class="price text-center">{{ product.price }} TSH</h5>
                                        <button class="d-flex btn btn-primary mx-auto mb-2" @click="submit(product.id)">ADD
                                            TO CART</button>
                                    </template>
                                </Card>
                            </div>

                        </div>
                    </template>
                </Card>
            </div>
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
                                    <td>{{ res.pivot.name }}</td>
                                    <td class="cart_quantity ">
                                        <div class="">
                                            <!--     "                           -->
                                            <form @submit.prevent>
                                                <input class="form-control form-control-sm" type="number" min="1"
                                                     onkeypress="return event.charCode>=48 event.charCode=13" v-model="res.pivot.quantity"
                                                    @change="change(res.pivot.quantity, res.id, index)">
                                            </form>
                                        </div>

                                    </td>
                                    <!-- if(event.value+''.match(/^0/)) return event.value =  event.value+''.replace(/^0/,'') -->
                                    <td>{{ (res.price * res.pivot.quantity).toFixed(2) }}Tsh</td>
                                    <td class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-danger" data-bs-toggle="popover" data-bs-trigger="hover"
                                            data-bs-placement="bottom" data-bs-title="Delete"
                                            @click="remove(res.pivot.product_id)"><i class="bi bi-trash"></i></button>
                                    </td>
                                </tr>


                            </template>
                        </Table>
                    </template>
                    <template v-slot:footer>
                        <div class="overflow-auto ">
                            <div class=" m-2 ">
                                <button class="btn btn-secondary w-100">TOTAL PRICE: <h4>{{ total().toFixed(2) }} TSH</h4>
                                </button>
                            </div>
                            <div class="d-flex justify-content-between m-2 gap-2 ">
                                <button class="btn btn-success" @click="createOrder()">ADD ORDER</button>
                                <button class="btn btn-danger" @click="empty()">CLEAR ALL</button>
                            </div>
                        </div>

                    </template>
                </Card>
            </div>
        </div>
    </Layout>
</template>