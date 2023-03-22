
<template>
    <div class="card">
        <TabMenu :model="items" />
        <router-view />
    </div>
</template>

<script setup>
import { ref } from "vue";

// const active = ref(3);
const items = ref([
    {
        label: 'Home',
        icon: 'pi pi-fw pi-home',
        to: '/',
    },
    {
        label: 'Calendar',
        icon: 'pi pi-fw pi-calendar',
        to: '/',
    },
    {
        label: 'Edit',
        icon: 'pi pi-fw pi-pencil',
        to: '/',
    },
    {
        label: 'Documentation',
        icon: 'pi pi-fw pi-file',
        to: '/',
    },
    {
        label: 'Settings',
        icon: 'pi pi-fw pi-cog',
        to: '/',
    }
]);
</script>