<template>
    <div class="bg-white">
      <div class="mx-auto max-w-2xl py-16 px-4 mb-10 sm:py-2 sm:px-6 lg:max-w-7xl lg:px-8">
        <h2 class="sr-only">Products</h2>

        <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8 ">
          <a v-for="product in products" :key="product.id" :href="product.href" class="group hover:bg-neutral-50">
            <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-gray-200 xl:aspect-w-7 xl:aspect-h-8" >
              <img :src="product.gambar" :alt="product.gambar"
                class="h-full w-full object-cover object-center group-hover:opacity-75" />
            </div>
            <h3 class="mt-4 text-sm text-center text-gray-700">{{ product.nama_barang }}</h3>
            <p class="mt-1 text-lg text-center font-medium text-gray-900">{{ product.harga_ritel }} s/d {{ product.harga_proyek }}</p>
            <button class="btn btn-xs mx-10 mt-3 rounded">+ Keranjang</button>
          </a>
        </div>
      </div>
    </div>
</template>

<script setup>

defineProps({
  products: Array,
})

</script>