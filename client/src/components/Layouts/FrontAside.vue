<template>
    <aside class="min-h-screen w-96 pb-20  px-6 py-10" :class="{'close': !isOpen}">
        <img :src="logo" alt="logo" class="">
        <nav class="flex flex-col my-3 gap-y-4 ">
            <div class="text-gray-400 text-sm mt-4">Menu</div>
            <nav-item to="/" text="Home">
                <IconSmartHome/>
            </nav-item>
            <nav-item to="/genres" text="Genres">
                <IconCategory/>
            </nav-item>

            <nav-item to="/albums" text="Albums">
                <IconDisc/>
            </nav-item>
            <nav-item to="/songs" text="Songs">
                <IconPlaylist/>
            </nav-item>

        </nav>
    </aside>
</template>

<script setup>
import logo from '../../assets/logo.png'
import NavItem from "./NavItem.vue";
import {
    IconCategory,
    IconDisc,
    IconPlaylist,
    IconSmartHome
} from '@tabler/icons-vue';

defineProps({
    isOpen: {
        type: Boolean,
        required: true
    }
})

</script>

<style scoped>

</style>
