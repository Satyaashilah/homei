<template>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <div class="bg-white">
        <div>
            <!-- Mobile filter dialog -->
            <TransitionRoot as="template" :show="mobileFiltersOpen">
                <Dialog as="div" class="relative z-40 lg:hidden" @close="mobileFiltersOpen = false">
                    <TransitionChild as="template" enter="transition-opacity ease-linear duration-300"
                        enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300"
                        leave-from="opacity-100" leave-to="opacity-0">
                        <div class="fixed inset-0 bg-black bg-opacity-25" />
                    </TransitionChild>

                    <div class="fixed inset-0 z-40 flex">
                        <TransitionChild as="template" enter="transition ease-in-out duration-300 transform"
                            enter-from="translate-x-full" enter-to="translate-x-0"
                            leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0"
                            leave-to="translate-x-full">
                            <DialogPanel
                                class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl">
                                <div class="flex items-center justify-between px-4">
                                    <h2 class="text-lg font-medium text-gray-900">Filters</h2>
                                    <button type="button"
                                        class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400"
                                        @click="mobileFiltersOpen = false">
                                        <span class="sr-only">Close menu</span>
                                        <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                                    </button>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </Dialog>
            </TransitionRoot>

            <div class="w-screen">
                <div class="pt-20 mx-10">
                    <table class="table-auto w-full justify-center mt-20 pt-20 mr-24">
                        <thead class="h-20 justify-center bg-gray-50 border-b-8 border-white">
                            <tr>
                                <th>
                                    <label class="ml-11">
                                        <input type="checkbox" class="checkbox" />
                                    </label>
                                </th>
                                <th class="w-1/6">Produk</th>
                                <th class="w-2/12"></th>
                                <th>Harga Satuan</th>
                                <th>Kuantitas</th>
                                <th>Total Harga</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="pt-20 bg-gray-50 border-t-4 border-white">
                            <tr>
                                <td>
                                    <label class="ml-11">
                                        <input type="checkbox" class="checkbox" />
                                    </label>
                                </td>
                                <td>
                                    <div class="w-20 h-20">
                                        <img src="./../assets/homei.png" alt="Avatar Tailwind CSS Component" />
                                    </div>
                                </td>
                                <td>
                                    Nama Produk
                                </td>
                                <td>Rp</td>
                                <td>
                                    <button class="btn btn-link px-2"
                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                        <i class="fas fa-minus"></i>
                                    </button>

                                    <input id="form1" min="0" name="quantity" value="1" type="number"
                                        class="form-control form-control-sm" style="width: 50px;" />

                                    <button class="btn btn-link px-2"
                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </td>
                                <td>Rp</td>
                                <td class="text-center">
                                    <button
                                        class=" :outline-none text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-sm text-sm w-16 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                        Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="bg-grey-300 h-20 absolute inset-x-0 bottom-0">
                        <table class="table-auto w-full justify-center mt-20 pt-20 mr-24">
                            <thead class="h-20 justify-center bg-gray-50 border-b border-grey-200">
                                <tr>
                                    <th>
                                        <label class="ml-11 mr-11">
                                            <input type="checkbox" class="checkbox" />
                                        </label>
                                        Pilih Semua
                                    </th>
                                    <th class="w-2/12"></th>
                                <th></th>
                                <th></th>
                                <th class="text-right font-medium text-sm text-gray-600">Total Harga :</th>
                                    <th >
                                        Rp
                                    </th>
                                    <th class="text-right">
                                        <button
                                        class=":outline-none mr-11 text-white bg-yellow-300 hover:bg-yellow-300 focus:ring-4 focus:ring-yellow-300 font-medium rounded-sm text-sm w-16 py-2 bg-yellow-300 :hover:bg-yellow-200 focus:ring-yellow-200">
                                        Bayar</button>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script setup>
import Catalogue from './Catalogue.vue'
import Pagination from './Pagination.vue'
import { ref, onMounted } from 'vue'
import {
    Dialog,
    DialogPanel,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'
import { XMarkIcon } from '@heroicons/vue/24/outline'
import { ChevronDownIcon, FunnelIcon, MinusIcon, PlusIcon, Squares2X2Icon } from '@heroicons/vue/20/solid'
import CartServices from '../services/CartServices'

function fetchCart() {
    const cartService = new CartServices();

    cartService.getProducts().then(response => {

    });

}

const mobileFiltersOpen = ref(false)

onMounted(() => {
    fetchCart();
})
</script>