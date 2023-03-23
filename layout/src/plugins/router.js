import {createRouter, createWebHistory} from 'vue-router'

const routes = [
    {path: '', name: 'home', component: () => import('@/views/home.vue')},
    {path: '/cart', name: 'cart', component: () => import('@/views/cart.vue')},
]

const router = createRouter({
    routes,
    history: createWebHistory(),
})

export default router