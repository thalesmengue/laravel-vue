import {createRouter, createWebHistory} from "vue-router";
import Guard from '../services/middleware';
import Login from '../pages/Login.vue';
import Register from '../pages/Register.vue';
import ProductIndex from "../pages/ProductIndex.vue";
import ProductStore from "../pages/ProductStore.vue";
import ProductShow from "../pages/ProductShow.vue";
import ProductUpdate from "../pages/ProductUpdate.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'Login',
            component: Login
        },
        {
            path: '/register',
            name: 'Register',
            component: Register
        },
        {
            path: '/index',
            name: 'ProductIndex',
            component: ProductIndex,
            beforeEnter: Guard.auth
        },
        {
            path: '/create',
            name: 'ProductStore',
            component: ProductStore,
            beforeEnter: Guard.auth
        },
        {
            path: '/show/:id',
            name: 'ProductShow',
            component: ProductShow,
            beforeEnter: Guard.auth
        },
        {
            path: '/update/:id',
            name: 'ProductUpdate',
            component: ProductUpdate,
            beforeEnter: Guard.auth
        },
    ]
})

 // router.beforeEach((to, from, next) => {
 //     const loggedIn = Cookies.get('token');
 //
 //     if (to.matched.some(record => record.meta.requiresAuth) && !loggedIn) {
 //         next({name: 'Login'})
 //     }
 //
 //     next()
 // })

export default router
