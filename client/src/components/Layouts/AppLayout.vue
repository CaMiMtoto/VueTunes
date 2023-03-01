<script setup>
import {
    IconCategory,
    IconDisc,
    IconPlaylist,
    IconChevronLeft,
    IconSearch,
    IconChevronDown,
    IconSmartHome,
    IconLogout,
    IconUser
} from '@tabler/icons-vue';
import logo from '../../assets/logo.png'
import NavItem from "./NavItem.vue";
import {Menu, MenuButton, MenuItems, MenuItem} from '@headlessui/vue'
import {useAuth} from "../../stores/auth.js";
import {onMounted, ref} from "vue";

const authStore = useAuth();

const isOpen = ref(false);

const toggle = () => {
    isOpen.value = !isOpen.value;
}
onMounted(() => {
    window.addEventListener("resize", function () {
        isOpen.value = window.innerWidth > 992;
    });
    isOpen.value = window.innerWidth > 992;
});
</script>
<template>
    <div class="min-h-screen w-full flex bg-[#F9F9F9] relative">
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
                <!--                <div>
                                    <div class="text-gray-400 text-sm  flex justify-between">
                                        <span>Playlists</span>
                                        <a href="">
                                            <IconCirclePlus/>
                                        </a>
                                    </div>
                                    <nav-item to="/me" text="Medications" class="font-normal py-1"></nav-item>
                                    <nav-item to="/me" text="About Space" class="font-normal py-1"></nav-item>
                                    <nav-item to="/me" text="Sleep" class="font-normal py-1"></nav-item>
                                    <nav-item to="/me" text="Book cast" class="font-normal py-1"></nav-item>
                                    <nav-item to="/me" text="Motivations" class="font-normal py-1"></nav-item>
                                </div>-->

            </nav>
        </aside>
        <div class="min-h-screen w-full pb-20 bg-[#F9F9F9]">
            <nav class="px-6 py-6  flex gap-3 items-center justify-between">
                <button type="button" @click="toggle"
                        class="bg-primary text-white rounded-full flex items-center justify-center p-2 hover:bg-primary-dark">
                    <IconChevronLeft class="transform " :class="{'rotate-180': !isOpen}"/>
                </button>
                <div class="relative md:w-1/2 mr-3 hidden md:block">

                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <IconSearch class="w-4 text-gray-500"/>
                    </div>
                    <input id="member_email"
                           class="bg-white border border-gray-100 text-gray-900 text-sm rounded-full focus:outline-none  block w-full pl-10 p-2.5 focus:border-primary focus:ring-1 focus:ring-primary"
                           name="search" placeholder="Search.."
                           required="" type="search"/>
                </div>

                <div class="flex items-center" v-if="authStore.user.data !=null">
                    <div class="mr-2">
                        <div>{{ authStore.user.data.name }}</div>
                    </div>
                    <Menu as="div" class="relative inline-block text-left">
                        <div>
                            <MenuButton
                                class="inline-flex w-10 h-10 items-center justify-center rounded-full bg-primary-light   text-sm font-medium text-primary-dark"
                            >
                                <IconUser/>
                            </MenuButton>
                        </div>

                        <transition
                            enter-active-class="transition duration-100 ease-out"
                            enter-from-class="transform scale-95 opacity-0"
                            enter-to-class="transform scale-100 opacity-100"
                            leave-active-class="transition duration-75 ease-in"
                            leave-from-class="transform scale-100 opacity-100"
                            leave-to-class="transform scale-95 opacity-0"
                        >
                            <MenuItems
                                class="absolute right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <div class="px-1 py-1">
                                    <MenuItem v-slot="{ active }">
                                        <router-link to="/dashboard"
                                                     :class="[
                                              active ? 'bg-primary text-white' : 'text-gray-900',
                                              'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                            ]"
                                        >
                                            <IconUser
                                                :active="active"
                                                class="mr-2 h-5 w-5"
                                                aria-hidden="true"
                                            />
                                            Dashboard
                                        </router-link>
                                    </MenuItem>
                                </div>

                                <div class="px-1 py-1">
                                    <MenuItem v-slot="{ active }">
                                        <button @click="authStore.logout()"
                                                :class="[
                                              active ? 'bg-primary text-white' : 'text-gray-900',
                                              'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                            ]"
                                        >
                                            <IconLogout
                                                :active="active"
                                                class="mr-2 h-5 w-5"
                                                aria-hidden="true"
                                            />
                                            Logout
                                        </button>
                                    </MenuItem>
                                </div>
                            </MenuItems>
                        </transition>
                    </Menu>
                    <IconChevronDown/>
                </div>
                <div v-else>
                    <router-link to="/login"
                                 class="bg-primary text-white rounded-lg flex items-center justify-center px-8 py-1">
                        Login
                    </router-link>
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
