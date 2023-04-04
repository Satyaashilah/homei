import { createRouter, createWebHistory } from 'vue-router'
import Home from './../views/Home.vue';
import Cart from './../views/Cart.vue';
import Catalogue from './../views/Catalogue.vue';
import ProductDetail from './../views/ProductDetail.vue';
import Payment from '../components/Payment.vue';

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
    {
        path: '/payment',
        name: 'Payment',
        component: () => import('./../views/Payment.vue')
    },
    {
        path: '/catalogue',
        name: 'Catalogue',
        component: () => import('./../views/Catalogue.vue')
    },
    {
        path: '/productdetail',
        name: 'ProductDetail',
        component: () => import('./../views/ProductDetail.vue')
    },
]

const router = createRouter({
    routes,
    history: createWebHistory(),
})

export default router