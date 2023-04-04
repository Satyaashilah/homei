<template>
  <!-- <Loader :loading="showLoader" /> -->
  <Navbar />
  <CatalogueList :products="products" @selectMaterial="_selectMaterial" @namaBarang="search"/>
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

const materialId = ref(null);

function getProduct(params) {
  var productservices = new ProductServices()
  productservices.getProducts(params).then(response => {
    const responseBody = response.data;
    products.value = responseBody.data;

    _meta.value = responseBody._meta;
  })
}

function changePage(page)  {

  var params = {page: page};
  if (materialId.value != null) {
    params[material_id] = materialId.value
    
  }if (s)
  getProduct(params);
}

function _selectMaterial(materials) {
  getProduct({page: _meta.value.currentPage, material_id: materials})
}

function search(nama_barang){
  // console.log(event);
  getProduct({page: _meta.value.currentPage, nama_barang: nama_barang})
}

onMounted(() => {
  // ketika baru dibuka pagenya 1
  getProduct({page: 1})
})
</script>
  
<style scoped></style>
  