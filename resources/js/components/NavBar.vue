<script>
import Cookies from "js-cookie";

export default {
    name: "NavBar",
    data() {
        return {

        }
    },

    methods: {
        logout() {
            Cookies.remove('token')
            this.$router.push({name: 'Login'})
        },
    }
}
</script>

<template>
    <nav class="relative flex flex-wrap items-center justify-between px-2 py-3 bg-white mb-3 shadow">
        <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
            <div class="w-full relative flex justify-between lg:w-auto px-4 lg:static lg:block lg:justify-start">
                <a class="hover:opacity-75 text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap border-b-2
             px-1 pt-1 font-medium text-gray-900">
                    Orbital
                </a>
            </div>
            <div class="w-full relative flex justify-between lg:w-auto px-4 lg:static lg:block lg:justify-start mr-16 gap-8">
                <router-link class="hover:opacity-75 border-indigo-500 text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap
             border-b-2 px-1 pt-1 font-medium text-gray-900" to="/index">
                    Home
                </router-link>
            </div>
            <div class="lg:flex flex-grow items-center">
                <ul class="flex flex-col lg:flex-row list-none ml-auto">
                    <li class="nav-item">
                        <button class="hover:opacity-75 border-indigo-800 text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap
                     border-b-2 px-1 pt-1 font-medium text-gray-900" @click="logout">
                            Logout
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
