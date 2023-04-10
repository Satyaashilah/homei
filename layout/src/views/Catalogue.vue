<template>
  <Navbar />
  <CatalogueList :products="products" @selectMaterial="_selectMaterial" @namaBarang="search"/>
  <Pagination :meta="_meta" @changePage="changePage" />
</template>
  
<script setup>
import { ref, onMounted } from 'vue'
import Navbar from '../components/Navbar.vue'
import CatalogueList from '../components/CatalogueList.vue';
import ProductServices from '../services/ProductServices'
import Pagination from '../components/Pagination.vue'


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
  