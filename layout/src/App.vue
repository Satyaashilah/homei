<template>
  <ul>
  <li><router-link :to="(name: 'Home')">Home</router-link></li>
  <li><router-link :to="(name: 'Home')">Home</router-link></li>
  </ul>
</template>

<script setup>
import {RouterView, RouterLink} from 'vue-router'
</script>

<style scoped>
</style>
