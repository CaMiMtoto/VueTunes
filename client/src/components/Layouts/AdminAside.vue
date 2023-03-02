<template>
    <aside class="min-h-screen w-96 border-r px-6 py-10" :class="{'close': !isOpen}">
        <img :src="logo" alt="logo" class="">
        <nav class="flex flex-col my-3 gap-y-4 ">
            <div class="text-gray-400 text-sm mt-4">Menu</div>
            <nav-item to="/dashboard" text="Dashboard">
                <IconChartPie/>
            </nav-item>
            <nav-item to="/admin/genres" text="Manage Genres">
                <IconCategory/>
            </nav-item>

            <nav-item to="/admin/albums" text="Manage Albums">
                <IconDisc/>
            </nav-item>
            <nav-item to="/admin/songs" text="Manage Songs">
                <IconPlaylist/>
            </nav-item>


        </nav>
    </aside>
</template>

<script setup>
import {
    IconCategory,
    IconChartPie,
    IconDisc,
    IconPlaylist
} from '@tabler/icons-vue';
import logo from '../../assets/logo.png'
import NavItem from "./NavItem.vue";

defineProps({
    isOpen: {
        type: Boolean,
        required: true
    }
})
</script>

<style scoped>

</style>
