<template>
  <Navbar />
  <CatalogueList />
</template>
  
<script setup>
import { ref, onMounted } from 'vue'
import Navbar from '../components/Navbar.vue'
import CatalogueList from '../components/CatalogueList.vue';
import { Dialog, DialogPanel } from '@headlessui/vue'
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline'
import { ProductServices } from '../services/ProductServices'
import { RouterView, RouterLink } from 'vue-router'

const navigation = [
  { name: 'Home', href: '/' },
  { name: 'Cart', href: '/Cart' },
  { name: 'Catalogue', href: '/Catalogue' },
  { name: 'ProductDetail', href: '/ProductDetail' },
]

const mobileMenuOpen = ref(false)

function getProduct() {
  var productservices = new ProductServices()
  productservices.getProduct().then(val => {
    console.log(val);
  })
}

onMounted(() => {
  getProduct()
})
</script>
  
<style scoped></style>
  