<template>
  <!-- <Loader :loading="showLoader" /> -->
  <Navbar />
  <CatalogueList :products="products"/>
  <Pagination :meta="_meta" @changePage="changePage" />
</template>
  
<script setup>
import { ref, onMounted } from 'vue'
import Navbar from '../components/Navbar.vue'
import CatalogueList from '../components/CatalogueList.vue';
import { Dialog, DialogPanel } from '@headlessui/vue'
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline'
import ProductServices from '../services/ProductServices'
import Pagination from '../components/Pagination.vue'
import { RouterView, RouterLink } from 'vue-router'

const navigation = [
  { name: 'Home', href: '/' },
  { name: 'Cart', href: '/Cart' },
  { name: 'Catalogue', href: '/Catalogue' },
  { name: 'ProductDetail', href: '/ProductDetail' },
]

const mobileMenuOpen = ref(false)

const products = ref([]);
const _meta = ref({});


function getProduct(page) {
  var productservices = new ProductServices()
  productservices.getProduct(page).then(response => {
    const responseBody = response.data;
    products.value = responseBody.data;

    _meta.value = responseBody._meta;
  })
}

function changePage(page)  {
  getProduct(page);
}

onMounted(() => {
  // ketika baru dibuka pagenya 1
  getProduct(1)
})
</script>
  
<style scoped></style>
  