<template>
   <router-link :to="`/songs/album/${item.slug}`">
       <div class="rounded-lg hover:opacity-90 cursor-pointer relative">
           <img :src="item.cover_image_url" class="rounded-lg h-44 w-full object-cover object-top"
                alt="album cover"/>
           <div class="mt-3 py-2">
               <h3 class="mb-3 text-sm font-medium">{{ item.title }}</h3>
               <p class="text-xs text-gray-500 font-bold" >{{ $filters.dateFormat(item.release_date) }}</p>
           </div>

           <div class="absolute bottom-20 left-2">
            <span
                class="bg-primary-light text-primary text-xs font-medium  px-2.5 py-1 rounded-xl">
                {{ item.songs_count }} songs
            </span>
           </div>
       </div>
   </router-link>
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
