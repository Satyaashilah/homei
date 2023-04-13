<template>
<div class="bg-white">
    <header class="absolute inset-x-0 top-0 z-50">
      <div class="h-1/3 drop-shadow-md bg-neutral-50 mx-auto">
        <!-- <div class="w-11/12"> -->
        <nav class="w-auto flex items-center justify-between p-6 lg:px-8 " aria-label="Global">
          <div class="flex lg:flex-1">
            <a href="./" class="-m-1.5 p-1.5">
              <span class="sr-only">Your Company</span>
              <img class="h-16" src="./../assets/homei.png" alt="" />
            </a>
          </div>
          <div class="flex lg:hidden">
            <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700" @click="mobileMenuOpen = true">
              <span class="sr-only">Open main menu</span>
              <Bars3Icon class="h-6 w-6" aria-hidden="true" />
            </button>
          </div>
          <div class="hidden lg:flex lg:flex-1 lg:gap-x-12 lg:justify-end">
            <div class="ml-4 flow-root lg:ml-6">
                  <a href="./Cart" class="group -m-2 flex items-center p-2">
                    <ShoppingBagIcon class="h-6 w-6 flex-shrink-0 text-gray-400 group-hover:text-yellow-400" aria-hidden="true" />
                    <!-- <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-yellow-400">0</span> -->
                    <span class="sr-only">items in cart, view bag</span>
                  </a>
                </div>
            <a href="#" class="text-xl font-semibold leading-6 hover:text-yellow-400 text-gray-700">Log in/Register<span aria-hidden="true"></span></a>
          </div>
        </nav>
      <!-- </div> -->
      <Dialog as="div" class="lg:hidden" @close="mobileMenuOpen = false" :open="mobileMenuOpen">
        <div class="fixed inset-0 z-50" />
        <DialogPanel class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
          <div class="flex items-center justify-between">
            <a href="#" class="-m-1.5 p-1.5">
              <span class="sr-only">Your Company</span>
              <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="" />
            </a>
            <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" @click="mobileMenuOpen = false">
              <span class="sr-only">Close menu</span>
              <XMarkIcon class="h-6 w-6" aria-hidden="true" />
            </button>
          </div>
          <div class="mt-6 flow-root">
            <div class="-my-6 divide-y divide-gray-500/10">
              <div class="py-6">
                <RouterLink to="/views/Login" class="-mx-3 block rounded-lg py-2.5 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log in</RouterLink>
              </div>
            </div>
          </div>
        </DialogPanel>
      </Dialog>
    </div>
    </header>
  </div>

  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue'
  import { Dialog, DialogPanel } from '@headlessui/vue'
  import { Bars3Icon, XMarkIcon,ShoppingBagIcon } from '@heroicons/vue/24/outline'
  import  ProductServices  from '../services/ProductServices'
  import { RouterView, RouterLink } from 'vue-router'

  
  const mobileMenuOpen = ref(false)
  
  </script>
  
  <style scoped>
  </style>
  