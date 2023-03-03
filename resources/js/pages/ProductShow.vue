<script>
import NavBar from "../components/NavBar.vue";
import Cookies from "js-cookie";

export default {
    name: "ProductShow",
    components: {NavBar},
    data() {
        return {
            product: [],
        }
    },

    methods: {
        editProduct(id) {
            this.$router.push({name: 'ProductUpdate', params: {id: id}})
        }
    },

    created() {
        fetch(`http://127.0.0.1:8000/api/products/${this.$route.params.id}`, {
            headers: {
                'Authorization': 'Bearer ' + Cookies.get('token')
            }
        }).then(response => response.json())
            .then(res => {
                this.product = res.product
            })
    }
}
</script>

<template>
    <NavBar/>
    <section class="pt-16 bg-blueGray-50">
        <div class="w-full lg:w-4/12 px-4 mx-auto">
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg mt-16">
                <div class="px-6">
                    <div class="flex flex-wrap justify-center">
                        <div class="w-full px-4">
                            <div class="flex justify-center py-4 lg:pt-4 pt-8">
                                <div class="mr-4 p-3">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div>
                            <p class="leading-normal mt-0 mb-2 text-blueGray-400 uppercase text-center font-extrabold">
                                Product informations
                            </p>
                        </div>
                        <div class="mb-2 text-blueGray-600 mt-10 flex gap-1.5">
                            <div>
                                <p class="font-bold">Name: </p>
                            </div>
                            <div>
                                <p class="mr-2">{{ product.name }}</p>
                            </div>
                        </div>
                        <div class="mb-2 text-blueGray-600 mt-6 flex gap-1.5">
                            <div>
                                <p class="font-bold">Description: </p>
                            </div>
                            <div>
                                <p class="mr-2">{{ product.description }}</p>
                            </div>
                        </div>
                        <div class="mb-2 text-blueGray-600 mt-6 flex gap-1.5">
                            <div>
                                <p class="font-bold">Price: </p>
                            </div>
                            <div>
                                <p class="mr-2">{{ product.price }}</p>
                            </div>
                        </div>
                        <div class="mb-2 text-blueGray-600 mt-6 flex gap-1.5">
                            <div>
                                <p class="font-bold">Image: </p>
                            </div>
                            <div>
                                <img :src="/storage/ + product.image" class="mr-2 h-24 ">
                            </div>
                        </div>
                    </div>
                    <div class="mt-10 py-10 border-t border-blueGray-200 text-center">
                        <div class="flex flex-wrap justify-center text-blue-500">
                            <button class="flex flex-row ml-12 text-blue-500" @click="editProduct(product.id)">
                                Edit
                            </button>
                            <button class="flex flex-row ml-12 text-red-500">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
