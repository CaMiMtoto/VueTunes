<template>
    <div class="min-h-screen grid md:grid-cols-2 bg-gray-50">
        <div class="py-12 px-4 h-full sm:px-6 lg:px-32 flex items-center flex-col justify-center">
            <div class="my-8  text-center">
                <h4 class="font-bold text-3xl">{{ title }}</h4>
                <p class="text-gray-500">{{ subtitle }}</p>
            </div>
            <slot></slot>
        </div>
        <div class="h-full w-full bg-contain bg-center bg-no-repeat bg-white"
             :style="{ backgroundImage: `url(${bg})` }"></div>

    </div>
</template>

<script setup>
import bg from '../../assets/login_bg.jpg';

defineProps({
    title: {
        type: String,
        required: true
    },
    subtitle: {
        type: String,
        required: false
    },

})


</script>

<style scoped>

</style>
