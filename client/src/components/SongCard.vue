<template>
    <div
        class="flex flex-col  md:flex-row justify-between items-center bg-white border-gray-200 rounded  md:flex-row hover:bg-gray-100">
        <div class="flex flex-col md:flex-row w-full md:w-auto">
            <img class="object-cover w-full md:w-24 h-full  rounded-t  md:rounded-none md:rounded-l"
                 :src="item.album.cover_image_url" alt="">

            <div class="flex flex-col justify-between px-4 leading-normal">
                <h5 class="text-sm  font-bold tracking-tight text-gray-900 ">
                    {{ item.title }}
                </h5>
                <router-link :to="`/songs/album/${item.album.slug}`" class="text-sm text-primary font-normal text-gray-70">
                    {{ item.album.title }}
                </router-link>
                <router-link :to="`/songs/genre/${item.genre.slug}`"  class="text-xs my-2 font-normal text-gray-70">
                    {{ item.genre.name }}
                </router-link>
                <p class="text-xs  text-gray-500 font-bold">{{ item.duration }}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    item: {
        type: Object,
        required: true
    }
})
</script>

<style scoped>

</style>
