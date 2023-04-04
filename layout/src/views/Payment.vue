<template>
    <Navbar />
    <Payment />
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue'
  import Navbar from '../components/Navbar.vue'
  import Payment from '../components/Payment.vue';
  import ProductServices from '../services/ProductServices'
  
  const desa = ref([]);
  function getDesa(id) {
  var productservices = new ProductServices()
  productservices.getDesa(id).then(response => {
    const responseBody = response.data;
    desa.value = responseBody.data;
  })
}
  onMounted(() => {
    // ketika baru dibuka pagenya 1
    getDesa()
  })

  </script>
  <style scoped></style>
  