<template>
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
                        class="inline-flex w-10 h-10 items-center justify-center rounded-full bg-primary-light  text-sm font-medium text-primary-dark"
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
                    class="z-50"
                >
                    <MenuItems
                        class="absolute right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                        <div class="px-1 py-1">
                            <MenuItem v-slot="{ active }">
                                <router-link :to="homeLink"
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
                                    {{ homeTitle}}
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
                         class="bg-primary-light text-primary-dark rounded-full flex items-center justify-center px-8 py-1 hover:bg-primary hover:text-white">
                Login
            </router-link>
        </div>
    </nav>
</template>

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

import {Menu, MenuButton, MenuItems, MenuItem} from '@headlessui/vue'
import {useAuth} from "../../stores/auth.js";

let props = defineProps({
    isOpen: {
        type: Boolean,
        required: true
    },
    homeLink: {
        type: String,
        required: true
    },
    homeTitle: {
        type: String,
        required: true
    }
})

let emit = defineEmits(['toggle'])

const authStore = useAuth();
const toggle = () => {
    emit('toggle')
}

</script>

<style scoped>

</style>
