<template>
    <div class="mt-20 pt-20 mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-lg text-center">
            <h1 class="text-2xl font-bold sm:text-3xl">Get started today!</h1>

            <p class="mt-4 text-gray-500">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Et libero nulla
                eaque error neque ipsa culpa autem, at itaque nostrum!
            </p>
        </div>

        <form @submit.prevent class="mx-auto mt-8 mb-0 max-w-md space-y-4">
            <div>
                <label for="username" class="sr-only">Username</label>

                <div class="relative">
                    <input v-model="usernameValue" type="usernameValue"
                        class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm"
                        placeholder="Enter username" />
                    <span class="absolute inset-y-0 right-0 grid place-content-center px-4">
                    </span>
                </div>
            </div>

            <div>
                <label for="password" class="sr-only">Password</label>

                <div class="relative">
                    <input v-model="passwordValue" 
                        class="w-full rounded-lg border-gray-200 p-4 pr-12 text-sm shadow-sm"
                        placeholder="Enter password" />
                    <!-- {{ login.password }} -->
                    <span class="absolute inset-y-0 right-0 grid place-content-center px-4">
                    </span>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <p class="text-sm text-gray-500">
                    No account?
                    <RouterLink to="/views/Register">Sign up</RouterLink>
                </p>
                <button @click="login"
                    class=":outline-none  text-white bg-blue-500 hover:bg-blue-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-sm text-sm w-16 py-2 bg-blue-500 :hover:bg-blue-400 focus:ring-blue-300">
                    Sign In</button>
            </div>
        </form>
    </div>
</template>
      
<script setup>
import { ref, onMounted } from 'vue'
import { Dialog, DialogPanel } from '@headlessui/vue'
import { Bars3Icon, XMarkIcon, ShoppingBagIcon } from '@heroicons/vue/24/outline'
import ProductServices from '../services/ProductServices'
import { RouterView, RouterLink } from 'vue-router'
import LoginServices from '../services/LoginServices'

function login() {
    const LoginUser = new LoginServices();

    LoginUser.login(usernameValue.value, passwordValue.value).then(response => {

    });

}

const usernameValue = ref()
const passwordValue = ref()
const mobileFiltersOpen = ref(false)

onMounted(() => {
})
</script>
      
<style scoped></style>
      