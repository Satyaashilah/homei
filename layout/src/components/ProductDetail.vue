<template>
    <div class="bg-white">
      <div class="pt-32">
        <nav aria-label="Breadcrumb">
          <ol role="list" class="mx-10 flex max-w-2xl items-center space-x-2 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <li v-for="breadcrumb in product.breadcrumbs" :key="breadcrumb.id">
              <div class="flex items-center">
                <a :href="breadcrumb.href" class="mr-2 text-sm font-medium text-gray-900">{{ breadcrumb.name }}</a>
                <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true" class="h-5 w-4 text-gray-300">
                  <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                </svg>
              </div>
            </li>
            <li class="text-sm">
              <a :href="product.href" aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">{{ product.name }}</a>
            </li>
          </ol>
        </nav>
  
        <!-- Image gallery -->
        <div class="mx-10 mt-6 max-w-2xl sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-2 lg:gap-x-20 lg:px-8">
          <div class="aspect-w-3 aspect-h-4 hidden overflow-hidden rounded-lg lg:block">
            <img :src="product.images[0].src" :alt="product.images[0].alt" class="h-full w-full object-cover object-center" />
          </div>
          
          <div class="mx-10 max-w-none px-4 pt-10 pb-16 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-2 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:pt-16 lg:pb-24">
            <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
              <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">{{ product.name }}</h1>
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
                <h3 class="text-sm font-medium text-gray-900">Highlights</h3>
    
                <div class="mt-4">
                  <ul role="list" class="list-disc space-y-2 pl-4 text-sm">
                    <li v-for="highlight in product.highlights" :key="highlight" class="text-gray-400">
                      <span class="text-gray-600">{{ highlight }}</span>
                    </li>
                  </ul>
                </div>
              </div>
    
              <div class="mt-10">
                <h2 class="text-sm font-medium text-gray-900">Details</h2>
    
                <div class="mt-4 space-y-6">
                  <p class="text-sm text-gray-600">{{ product.details }}</p>
                </div>
                <p class="text-3xl tracking-tight text-gray-900">{{ product.price }}</p>
                <button type="submit" class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-yellow-300 py-3 px-8 text-base font-medium text-gray-800 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add to bag</button>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Product info -->
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
    breadcrumbs: [
      { id: 1, name: 'Men', href: '#' },
      { id: 2, name: 'Clothing', href: '#' },
    ],
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
    highlights: [
      'Hand cut and sewn locally',
      'Dyed with our proprietary colors',
      'Pre-washed & pre-shrunk',
      'Ultra-soft 100% cotton',
    ],
    details:
      'The 6-Pack includes two black, two white, and two heather gray Basic Tees. Sign up for our subscription service and be the first to get new, exciting colors, like our upcoming "Charcoal Gray" limited release.',
  }
  const reviews = { href: '#', average: 4, totalCount: 117 }
  
  const selectedColor = ref(product.colors[0])
  const selectedSize = ref(product.sizes[2])
  </script>