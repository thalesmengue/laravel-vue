<script>
import NavBar from "../components/NavBar.vue";
import router from "../router";
import Cookies from "js-cookie";
import axios from "axios";

export default {
    name: "ProductIndex",
    components: {NavBar},

    data() {
        return {
            products: [],
        }
    },

    methods: {
        addProduct() {
            router.push('/create')
        },

        showProduct(id) {
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + Cookies.get('token')
                }
            }

            axios.get(`http://127.0.0.1:8000/api/products/${id}`, config)
                .then(res => {
                    this.$router.push({name: 'ProductShow', params: {id: id}})
                })
        },

        deleteProduct(id) {
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + Cookies.get('token')
                }
            }

            axios.delete(`http://127.0.0.1:8000/api/products/${id}`, config)
                .then(res => {
                    location.reload()
                })
        }
    },

    created() {
        const config = {
            headers: {
                'Authorization': 'Bearer ' + Cookies.get('token')
            }
        }

        axios.get(`http://127.0.0.1:8000/api/products`, config)
            .then(res => {
                this.products = res.data.products
            })
    }
}
</script>

<template>
    <NavBar/>
    <div class="px-4 sm:px-6 lg:px-8 mt-16">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Products</h1>
                <p class="mt-2 text-sm text-gray-700 mt-4">Here stay the list of all the registered products</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <button @click="addProduct" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent
                bg-indigo-600 px-4 py-2 text-sm mt-4 font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none
                focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Add Product
                </button>
            </div>
        </div>
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">ID
                                </th>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name
                                </th>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                    Description
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody v-if="products" v-for="product in products"
                                   class="divide-y divide-gray-200 bg-white">
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                    {{ product.id }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"> {{ product.name }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"> {{
                                        product.description
                                    }}
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <button @click="showProduct(product.id)"
                                            class="text-indigo-600 hover:text-indigo-900">Show
                                    </button>
                                    <button @click="deleteProduct(product.id)"
                                            class="text-red-600 hover:text-red-900 ml-6"> Delete
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

