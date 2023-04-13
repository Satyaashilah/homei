import { createRouter, createWebHistory } from 'vue-router'
import Home from './../views/Home.vue';
import Cart from './../views/Cart.vue';
import Catalogue from './../views/Catalogue.vue';
import ProductDetail from './../views/ProductDetail.vue';
import Payment from '../views/Payment.vue';
import Shipment from '../views/Shipment.vue';
import Profile from '../views/Profile.vue';
import History from '../views/History.vue';
import Login from '../views/Login.vue';
import Register from '../views/Register.vue';

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
        path: '/profile',
        name: 'Profile',
        component: () => import('./../views/Profile.vue')
    },
    {
        path: '/payment',
        name: 'Payment',
        component: () => import('./../views/Payment.vue')
    },
    {
        path: '/shipment',
        name: 'Shipment',
        component: () => import('./../views/Shipment.vue')
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
    {
        path: '/history',
        name: 'History',
        component: () => import('./../views/History.vue')
    },
    {
        path: '/login',
        name: 'Login',
        component: () => import('./../views/Login.vue')
    },
    {
        path: '/register',
        name: 'Register',
        component: () => import('./../views/Register.vue')
    },
]

const router = createRouter({
    routes,
    history: createWebHistory(),
})

export default router