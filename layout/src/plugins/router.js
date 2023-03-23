import { createRouter, createWebHistory } from 'vue-router'
import Home from './../views/Home.vue';
import Cart from './../views/Cart.vue';

const routes = [
    {
        path: '',
        name: 'Home',
        component: () => import('./../views/Home.vue')
    },
    {
        path: '/cart',
        name: 'Cart',
        component: () => import('./../views/Cart.vue')
    },
]

const router = createRouter({
    routes,
    history: createWebHistory(),
})

export default router