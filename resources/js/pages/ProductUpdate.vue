<script>
import NavBar from "../components/NavBar.vue";
import Cookies from "js-cookie";
import axios from "axios";

export default {
    name: "ProductUpdate",
    components: {NavBar},
    data() {
        return {
            errors: [],
            product: {
                name: '',
                description: '',
                price: '',
                image: '',
            }
        }
    },

    methods: {
        onChange($evt) {
            this.product.image = $evt.target.files[0];
        },

        formSubmitUpdate(e) {
            e.preventDefault()
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + Cookies.get('token'),
                    'Content-Type': 'multipart/form-data',
                }
            }

            let formData = new FormData();
            formData.append("name", this.product.name);
            formData.append("description", this.product.description);
            formData.append("price", this.product.price);
            formData.append("image", this.product.image);
            formData.append('_method', 'PUT')

            axios.post(`http://127.0.0.1:8000/api/products/update/${this.$route.params.id}`, formData, config)
                .then(res => {
                    this.$router.push(`/show/${this.$route.params.id}`)
                })
                .catch(err => {
                    this.errors = err.response.data.errors
                    console.log(err)
                })
        }
    },

    created() {
        axios.get(`http://127.0.0.1:8000/api/products/${this.$route.params.id}`, {
            headers: {
                'Authorization': 'Bearer ' + Cookies.get('token')
            }
        }).then(res => {
            this.product = res.data.product
        })
    }
}
</script>

<template>
    <NavBar/>
    <div class="flex items-center justify-center mt-24">
        <div class="px-8 py-6 mx-4 mt-4 text-left bg-white shadow-lg md:w-1/3 lg:w-1/3 sm:w-1/3">
            <h3 class="text-2xl font-bold text-center">Edit a product</h3>
            <form method="post" enctype="multipart/form-data">
                <div class="mt-4">
                    <div>
                        <label class="block" for="name">Name</label>
                        <input type="text" placeholder="name" name="name" id="name" v-model="product.name"
                               class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                    </div>
                    <div>
                        <div class="text-center text-xs text-red-600 mt-2">
                            <span v-if="errors.name">{{ errors.name[0] }}</span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block" for="description">Description</label>
                        <input type="text" placeholder="description" name="description" id="description"
                               v-model="product.description"
                               class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                    </div>
                    <div>
                        <div class="text-center text-xs text-red-600 mt-2">
                            <span v-if="errors.description">{{ errors.description[0] }}</span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block" for="price">Price</label>
                        <input type="text" placeholder="price" name="price" id="price" v-model="product.price"
                               class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                    </div>
                    <div>
                        <div class="text-center text-xs text-red-600 mt-2">
                            <span v-if="errors.price">{{ errors.price[0] }}</span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="mb-2 inline-block" for="image">Image</label>
                        <input type="file" placeholder="image" name="image" id="image" @change="onChange"
                               class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border
                                   border-solid border-neutral-300 bg-white bg-clip-padding px-3 py-1.5 text-base
                                   font-normal text-neutral-700 outline-none transition duration-300 ease-in-out
                                   file:-mx-3 file:-my-1.5 file:cursor-pointer file:overflow-hidden file:rounded-none
                                   file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3
                                   file:py-1.5 file:text-neutral-700 file:transition file:duration-150 file:ease-in-out
                                   file:[margin-inline-end:0.75rem] file:[border-inline-end-width:1px] hover:file:bg-neutral-200
                                    focus:border-primary focus:bg-white focus:text-neutral-700 focus:shadow-[0_0_0_1px]
                                    focus:shadow-primary focus:outline-none">
                    </div>
                    <div class="flex justify-center items-center">
                        <button class="px-6 py-2 mt-4 text-white bg-indigo-600 rounded-lg hover:bg-indigo-900"
                                @click="formSubmitUpdate"> save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
