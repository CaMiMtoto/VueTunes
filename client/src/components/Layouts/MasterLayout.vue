<script setup>
import {
    IconCategory,
    IconChartPie,
    IconDisc,
    IconPlaylist,
    IconChevronLeft,
    IconSearch,
    IconChevronDown,
    IconCopy, IconEdit, IconLogout, IconSettings, IconUser
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
    <div class="min-h-screen w-full flex bg-[#F1F1F5]">
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
        <div class="min-h-screen w-full bg-[#F9F9F9]">
            <nav class="px-6 py-6  flex gap-3 items-center justify-between">
                <button type="button" @click="toggle"
                        class="bg-primary text-white rounded-full flex items-center justify-center p-2">
                    <IconChevronLeft class="transform " :class="{'rotate-180': !isOpen}"/>
                </button>


                <div class="flex items-center">
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
                                        <button
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
                                            Profile
                                        </button>
                                    </MenuItem>
                                    <MenuItem v-slot="{ active }">
                                        <button
                                            :class="[
                                              active ? 'bg-primary text-white' : 'text-gray-900',
                                              'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                            ]"
                                        >
                                            <IconSettings
                                                :active="active"
                                                class="mr-2 h-5 w-5"
                                                aria-hidden="true"
                                            />
                                            Settings
                                        </button>
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

            </nav>
            <main class="px-10 py-6">
                <router-view></router-view>
            </main>
        </div>

    </div>
</template>


<style scoped>

</style>
