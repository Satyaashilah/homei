<template>
    <div class="grid grid-cols-3 gap-4 bg-gray">
        <div class="col-span-1 border border-gray">
            aa
        </div>
        <div class="w-full h-96 bg-gray border">
            <img :src="product.images[0].src" :alt="product.images[0].alt"
                class="h-full w-full object-cover object-center" />
        </div>
        <div class="col-span-2 border border-gray">
                <div class="font-medium text-xl text-grey-800 ml-20">
                    Nama Barang
                </div>
            </div>
    </div>
    <!-- <div class="mt-20 pt-20 mx-20">
        <div class="grid grid-cols-3 gap-4 bg-gray ">
            <div class="col-span-1 border border-gray">assaa
                <div class="w-full h-96 bg-gray border">
                    <img :src="product.images[0].src" :alt="product.images[0].alt"
                        class="h-full w-full object-cover object-center" />
                </div>
            </div>
            <div class="col-span-2 border border-gray">
                <div class="font-medium text-xl text-grey-800 ml-20">
                    Nama Barang
                </div>
            </div>
        </div>
        <div class="mt-20 font-large font-bold text-2xl text-center text-gray-900">
            BARANG TERKAIT
        </div>
    </div> -->
</template>
  
<script setup>
import { ref } from 'vue'
import { StarIcon } from '@heroicons/vue/20/solid'
import { RadioGroup, RadioGroupLabel, RadioGroupOption } from '@headlessui/vue'

</script>