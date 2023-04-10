<template>
  <Navbar />
  <ProductDetail :products="products"/>
</template>

<script setup>
import { ref } from 'vue'
import Navbar from '../components/Navbar.vue'
// import Navbar from '../components/Navbar.vue';
import ProductDetail from '../components/ProductDetail.vue';
import ProductServices from '../services/ProductServices'
const products = ref([]);
function getProduct(params) {
  var productservices = new ProductServices()
  productservices.getProducts(params).then(response => {
    const responseBody = response.data;
    products.value = responseBody.data;

    _meta.value = responseBody._meta;
  })
}
</script>

<style scoped></style>
