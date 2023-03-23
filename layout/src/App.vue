<template>
  <!-- <ul>
    <li><router-link :to="{name: 'Home'}">Home</router-link></li>
    <li><router-link :to="{name: 'Cart'}">Cart</router-link></li>
  </ul> -->
  <router-view />
</template>
<script setup>

import { RouterView, RouterLink } from 'vue-router'
</script>

<style scoped></style>
