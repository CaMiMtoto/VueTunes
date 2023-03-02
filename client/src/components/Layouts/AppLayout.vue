<script setup>

import {onMounted, ref} from "vue";
import TopNav from "./TopNav.vue";
import FrontAside from "./FrontAside.vue";

const isOpen = ref(false);

onMounted(() => {
    window.addEventListener("resize", function () {
        isOpen.value = window.innerWidth > 992;
    });
    isOpen.value = window.innerWidth > 992;
});
</script>
<template>
    <div class="min-h-screen w-full flex bg-[#F9F9F9] relative">
        <FrontAside :is-open="isOpen"/>
        <div class="min-h-screen w-full pb-20 bg-[#F9F9F9]">
            <TopNav :is-open="isOpen" @toggle="isOpen=!isOpen" home-link="/dashboard" home-title="Dashboard"/>
            <main class="px-10 py-6">
                <router-view></router-view>
            </main>
        </div>
    </div>
</template>


<style scoped>

</style>
