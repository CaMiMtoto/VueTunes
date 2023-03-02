<script setup>

import {onMounted, ref} from "vue";
import TopNav from "./TopNav.vue";
import AdminAside from "./AdminAside.vue";

const isOpen = ref(false);

onMounted(() => {
    window.addEventListener("resize", function () {
        isOpen.value = window.innerWidth > 992;
    });
    isOpen.value = window.innerWidth > 992;
});
</script>
<template>
    <div class="min-h-screen w-full flex bg-[#F1F1F5]">
        <AdminAside :is-open="isOpen"/>
        <div class="min-h-screen w-full bg-[#F9F9F9]">
            <TopNav home-link="/" :is-open="isOpen" @toggle="isOpen=!isOpen" home-title="Home Page"/>
            <main class="px-10 py-6">
                <router-view></router-view>
            </main>
        </div>

    </div>
</template>


<style scoped>

</style>
