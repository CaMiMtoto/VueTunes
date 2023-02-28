<template>
    <div class="rounded-lg hover:opacity-60 cursor-pointer relative">
        <img :src="item.cover_image_url" class="rounded-lg h-44 w-full object-cover object-top"
             alt="album cover"/>
        <div class="mt-3 py-2">
            <h3 class="mb-3 font-medium">{{ item.title }}</h3>
            <p class="text-xs text-gray-500 font-bold" >{{ $filters.dateFormat(item.release_date) }}</p>
        </div>

        <div class="absolute bottom-24 left-2">
            <span
                class="bg-primary-light text-primary text-xs font-medium  px-2.5 py-1 rounded-lg">
                {{ item.songs_count }} songs
            </span>
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
