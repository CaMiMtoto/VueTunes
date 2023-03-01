<template>
    <div
         class="flex flex-col my-3 md:flex-row justify-between items-center bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row hover:bg-gray-100">
        <div class="flex flex-col md:flex-row w-full md:w-auto">
            <div class="h-24">
                <img class="object-cover w-full md:w-36 h-full  rounded-t-lg  md:rounded-none md:rounded-l-lg" :src="item.album.cover_image_url" alt="">
            </div>
            <div class="flex flex-col justify-between px-4 leading-normal">
                <h5 class="text-xl mt-2 font-bold tracking-tight text-gray-900 ">
                    {{ item.title }}
                </h5>
                <p class=" font-normal text-gray-70">
                    {{ item.album.title }}
                </p>
                <p class="text-xs mb-2 text-gray-500 font-bold">{{ item.duration }}</p>
            </div>
        </div>
        <div class="p-4">
            <button type="button" class="inline-flex items-center justify-center bg-primary p-3 rounded-full text-white">
                <IconPlayerPlayFilled/>
            </button>
        </div>
    </div>
</template>

<script setup>
import {IconChevronRight, IconPlayerPlayFilled} from "@tabler/icons-vue"
defineProps({
    item: {
        type: Object,
        required: true
    }
})
</script>

<style scoped>

</style>
