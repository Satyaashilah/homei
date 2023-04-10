<template>
    <Navbar />
    <Payment />
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue'
  import Navbar from '../components/Navbar.vue'
  import Payment from '../components/Payment.vue';
  import AddressServices from '../services/AddressServices'
  </script>
  <style scoped></style>
  