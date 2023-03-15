<script>
import Cookies from "js-cookie";

export default {
    name: "Register",
    data() {
        return {
            name: '',
            last_name: '',
            email: '',
            password: '',
            errors: [],
        }
    },

    methods: {
        register() {
            const config = {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Access': 'application/json',
                }
            }

            const data = {
                name: this.name,
                last_name: this.last_name,
                email: this.email,
                password: this.password
            }

            axios.post(`http://127.0.0.1:8000/api/register`, data, config)
                .then(res => {
                    this.$router.push({name: 'Login'})
                })
                .catch(err => {
                    this.errors = err.response.data.errors
                })
        }
    }
}
</script>

<template>
    <div class="flex min-h-full flex-col justify-center mt-16 py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Create your account</h2>
        </div>
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form class="space-y-6" @submit.stop.prevent="register" method="POST">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <div class="mt-1">
                            <input id="name" name="name" type="text" required="" v-model="name"
                                   class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2
                                   placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none
                                   focus:ring-indigo-500 sm:text-sm"/>
                        </div>
                        <div>
                            <div class="text-center text-xs text-red-600 mt-2">
                                <span v-if="errors.name">{{ errors.name[0] }}</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                        <div class="mt-1">
                            <input id="last_name" name="last_name" type="text" required="" v-model="last_name"
                                   class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2
                                   placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none
                                   focus:ring-indigo-500 sm:text-sm"/>
                        </div>
                        <div>
                            <div class="text-center text-xs text-red-600 mt-2">
                                <span v-if="errors.last_name">{{ errors.last_name[0] }}</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" autocomplete="email" required="" v-model="email"
                                   class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2
                                   placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none
                                   focus:ring-indigo-500 sm:text-sm"/>
                        </div>
                        <div>
                            <div class="text-center text-xs text-red-600 mt-2">
                                <span v-if="errors.email">{{ errors.email[0] }}</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="mt-1">
                            <input id="password" name="password" type="password" autocomplete="current-password"
                                   required="" v-model="password"
                                   class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400
                                    shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"/>
                        </div>
                        <div>
                            <div class="text-center text-xs text-red-600 mt-2">
                                <span v-if="errors.password">{{ errors.password[0] }}</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit"
                                class="flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2
                                px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none
                                focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Sign up
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
