<script setup>
import {
    IconCategory,
    IconChartPie,
    IconDisc,
    IconPlaylist,
    IconCirclePlus,
    IconChevronLeft,
    IconChevronRight,
    IconSearch
} from '@tabler/icons-vue';
import logo from '../../assets/vue.svg'
import NavItem from "./NavItem.vue";
</script>
<template>
    <div class="min-h-screen w-full flex bg-white">
        <aside class="min-h-screen w-96 bg-[#F2F1F5] px-6 py-10">
            <img :src="logo" alt="logo" class="w-10">
            <nav class="flex flex-col my-3 gap-y-4 ">
                <div class="text-gray-400 text-sm mt-4">Menu</div>
                <nav-item to="/dashboard" text="Dashboard">
                    <IconChartPie/>
                </nav-item>
                <nav-item to="/admin/genres" text="Genres">
                    <IconCategory/>
                </nav-item>

                <nav-item to="/admin/albums" text="Albums">
                    <IconDisc/>
                </nav-item>
                <nav-item to="/admin/songs" text="Songs">
                    <IconPlaylist/>
                </nav-item>
                <div>
                    <div class="text-gray-400 text-sm  flex justify-between">
                        <span>Playlists</span>
                        <a href="">
                            <IconCirclePlus/>
                        </a>
                    </div>
                    <nav-item to="/" text="Medications" class="font-normal py-1"></nav-item>
                    <nav-item to="/" text="About Space" class="font-normal py-1"></nav-item>
                    <nav-item to="/" text="Sleep" class="font-normal py-1"></nav-item>
                    <nav-item to="/" text="Bookcast" class="font-normal py-1"></nav-item>
                    <nav-item to="/" text="Motivations" class="font-normal py-1"></nav-item>
                </div>

            </nav>
        </aside>
        <div class="min-h-screen w-full bg-[#F9F9F9]">
            <nav class="px-6 py-6  flex gap-3 items-center justify-between">
                <button class="bg-primary text-white rounded-full flex items-center justify-center p-2">
                    <IconChevronLeft/>
                </button>
                <div class="relative md:w-1/2 mr-3">

                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <IconSearch class="w-4 text-gray-500"/>
                    </div>
                    <input id="member_email"
                           class="bg-white border border-gray-100 text-gray-900 text-sm rounded-full focus:outline-none  block w-full pl-10 p-2.5"
                           name="email_address" placeholder="Search.."
                           required="" type="email">
                </div>

                <div>
                    <h1>Hello</h1>
                </div>

            </nav>
            <main class="px-10 py-6">
                <router-view></router-view>
            </main>
        </div>

    </div>
</template>


<style scoped>

</style>
