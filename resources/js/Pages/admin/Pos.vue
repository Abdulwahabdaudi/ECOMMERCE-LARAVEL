<script>
import { router } from '@inertiajs/vue3'


import Layout from '../../Layouts/Layout.vue';
import Card from '../../Components/Card.vue'
import Table from '../../Components/Table.vue'
import Result from 'postcss/lib/result';

export default {
    data() {
        return {
            dataS:{
                id:null
            } ,
            dataC:{
                product_id:null,
                quantity:null
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
        result: Array
    },
    mounted(){
      
    },
    methods: {
        submit(data){
            this.dataS.id = data
      router.post('/admin/pos', this.dataS,{
        onError: (errors) =>{
            console.log(errors);
        }
      })
        },
        change(value1,value2){
 
            this.dataC.product_id=value2
                this.dataC.quantity = value1
                router.post('/admin/pos', this.dataC,{
                onSuccess: ()=>{
                    alert('message')
                },
        onError: (errors) =>{
            console.log(errors);
        }
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
                        <div class="row row-cols-lg-4 " >
                           
                            <div class="col " v-for="product in products" :key="product.id">
                                <Card class="cart">
                                    <template v-slot:head>
                                        <h5 class="">{{ product.name }}</h5>
                                    </template>
                                    <template v-slot:body>

                                        <img class="d-flex w-50 h-75 border border-primary border-3 mx-auto my-2"
                                            src="../../../../public/logo.jpg" alt="">

                                        <h5 class="price text-center">{{product.price}} TSH</h5>
                                        <button class="d-flex btn btn-primary mx-auto mb-2" @click="submit(product.id)">ADD TO CART</button>
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
                                <tr v-for="res in result" :key="result.id">
                                    <td>1</td>
                                <td>{{res.pivot.name}}</td>
                                <td class="cart_quantity ">
                                    <div class="">                                    
                                        <form @submit.prevent>
                                            <input
                                             class="form-control form-control-sm" 
                                             type="number" 
                                             
                                             v-model="res.pivot.quantity"
                                             @change="change(res.pivot.quantity,res.id)"></form>
                                    </div>

                                </td>
                                <td>{{res.pivot.price}}Tsh</td>
                                <td class="d-flex justify-content-center gap-2">
                                    <button class="btn btn-danger" data-bs-toggle="popover" data-bs-trigger="hover"
                                        data-bs-placement="bottom" data-bs-title="Delete"><i
                                            class="bi bi-trash"></i></button>
                                </td> 
                                </tr>
                               

                            </template>
                        </Table>
                    </template>
                    <template v-slot:footer >
                        <div class="overflow-auto d-flex justify-content-between m-2 gap-2 "><button class="btn btn-success">ADD ORDER</button><button class="btn btn-danger">CLEAR ALL</button></div>
                    </template>
                </Card>
            </div>
        </div>
    </Layout>
</template>