<template>
  <div class="bg-white">
    <div class="pt-32">
      <!-- <nav aria-label="Breadcrumb">
        <ol role="list" class="mx-10 flex max-w-2xl items-center space-x-2 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
          <li v-for="breadcrumb in product.breadcrumbs" :key="breadcrumb.id">
            <div class="flex items-center">
              <a :href="breadcrumb.href" class="mr-2 text-sm font-medium text-gray-900">{{ breadcrumb.name }}</a>
              <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true"
                class="h-5 w-4 text-gray-300">
                <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
              </svg>
            </div>
          </li>
          <li class="text-sm">
            <a :href="product.href" aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">{{
              product.name }}</a>
          </li>
        </ol>
      </nav> -->

      <!-- Image gallery -->
      <div class="items-center mx-10 max-w-xl sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-2 lg:gap-x-1 lg:pt-16 ">
        <div class="aspect-w-5 aspect-h-4 rounded lg:block">
          <img :src="product.images[0].src" :alt="product.images[0].alt"
            class="h-3/5 w-3/5 object-cover object-center" />
        </div>

        <div
          class="mx-10 max-w-none sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-2 lg:grid-rows lg:gap-x-8 lg:px-8 lg:pb-24">
          <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-20 space-y-6">
            <h1 class="ml-8 text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl ">{{ product.name }}</h1>
          </div>

          <!-- Options -->


          <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-l lg:border-gray-200 lg:pt-6 lg:pb-16 lg:pl-8">
            <!-- Description and details -->
            <div>
              <h3 class="sr-only">Description</h3>

              <div class="space-y-6">
                <p class="text-base text-gray-900">{{ product.description }}</p>
              </div>
            </div>



            <div class="mt-10">
              <h2 class="text-sm font-medium text-gray-900">Details</h2>

              <div class="mt-1 mb-10 space-y-6">
                <p class="text-sm text-gray-600">{{ product.details }}</p>
              </div>
              <p class="font-semibold  text-xl tracking-tight text-gray-700">Harga Ritel : {{ product.price }}</p>
              <p class="text-sm tracking-tight text-gray-700">Maksimal Pembelian : {{ product.price }}</p>
              <p class="font-semibold  text-xl tracking-tight text-gray-700">Harga Proyek : {{ product.price }}</p>
              <p class="text-sm tracking-tight text-gray-700">Minimal Pembelian : {{ product.price }}</p>
              <p class="font-semibold text-xl tracking-tight text-gray-700">Stok : {{ product.price }}</p>
              <div class="grid grid-cols-2">
                <div>
                  <button class="btn btn-link "
                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                    <i class="fas fa-minus"></i>
                  </button>
                  <input id="form1" min="0" name="quantity" value="1" type="number" class="form-control form-control-sm"
                    style="width: 70px;" />
                  <button class="btn btn-link px-2"
                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
                <div>
                  <button type="submit"
                    class="mt-10 flex w-full items-center justify-center rounded border border-transparent bg-yellow-300 py-3 px-8 text-base font-medium text-gray-800 hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:ring-offset-2">Add
                    to bag</button>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- Product info -->
      <div class="flex justify-center">
        BARANG TERKAIT
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
  </div>
</template>
  
<script setup>
import { ref } from 'vue'
import { StarIcon } from '@heroicons/vue/20/solid'
import { RadioGroup, RadioGroupLabel, RadioGroupOption } from '@headlessui/vue'

const product = {
  name: 'Pasir',
  price: '$192',
  href: '#',
  // breadcrumbs: [
  //   { id: 1, name: 'Men', href: '#' },
  //   { id: 2, name: 'Clothing', href: '#' },
  // ],
  images: [
    {
      src: 'https://tailwindui.com/img/ecommerce-images/product-page-02-secondary-product-shot.jpg',
      alt: 'Two each of gray, white, and black shirts laying flat.',
    },
    {
      src: 'https://tailwindui.com/img/ecommerce-images/product-page-02-tertiary-product-shot-01.jpg',
      alt: 'Model wearing plain black basic tee.',
    },
    {
      src: 'https://tailwindui.com/img/ecommerce-images/product-page-02-tertiary-product-shot-02.jpg',
      alt: 'Model wearing plain gray basic tee.',
    },
    {
      src: 'https://tailwindui.com/img/ecommerce-images/product-page-02-featured-product-shot.jpg',
      alt: 'Model wearing plain white basic tee.',
    },
  ],
  colors: [
    { name: 'White', class: 'bg-white', selectedClass: 'ring-gray-400' },
    { name: 'Gray', class: 'bg-gray-200', selectedClass: 'ring-gray-400' },
    { name: 'Black', class: 'bg-gray-900', selectedClass: 'ring-gray-900' },
  ],
  sizes: [
    { name: 'XXS', inStock: false },
    { name: 'XS', inStock: true },
    { name: 'S', inStock: true },
    { name: 'M', inStock: true },
    { name: 'L', inStock: true },
    { name: 'XL', inStock: true },
    { name: '2XL', inStock: true },
    { name: '3XL', inStock: true },
  ],
  description:
    'The Basic Tee 6-Pack allows you to fully express your vibrant personality with three grayscale options. Feeling adventurous? Put on a heather gray tee. Want to be a trendsetter? Try our exclusive colorway: "Black". Need to add an extra pop of color to your outfit? Our white tee has you covered.',
  details:
    'The 6-Pack includes two black, two white, and two heather gray Basic Tees.',
}
const reviews = { href: '#', average: 4, totalCount: 117 }

const selectedColor = ref(product.colors[0])
const selectedSize = ref(product.sizes[2])
</script>