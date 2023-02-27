<script setup>
import {IconChevronRight, IconPlayerPlayFilled} from "@tabler/icons-vue"
import {onMounted, ref} from "vue";
import http from "../config/axiosClient.js";

let albums = ref([]);
let songs = ref([]);

let fetchAlbums = () => {
    http.get('/albums?per_page=4')
        .then((response) => {

            albums.value = response.data.data;
        })
        .catch((error) => {
            console.log(error);
        });
}

let fethSongs = () => {
    http.get('/songs?per_page=4')
        .then((response) => {

            songs.value = response.data.data;
        })
        .catch((error) => {
            console.log(error);
        });
}

onMounted(() => {
    fetchAlbums();

    fethSongs();
});


</script>

<template>
    <div class="flex flex-col gap-4">
        <div>
            <div class="mb-4 flex items-center justify-between">
                <h1 class="text-2xl font-bold text-primary">For You</h1>
                <router-link to="/albums" class="text-sm text-primary font-bold inline-flex items-center">
                    See All
                    <IconChevronRight/>
                </router-link>
            </div>
            <div class="grid md:grid-cols-4 grid-cols-1 gap-3 md:gap-8" v-if="albums.length">
                <div v-for="item in albums" class="rounded-lg hover:opacity-60 cursor-pointer relative">
                    <img :src="item.cover_image_url" class="rounded-lg h-44 w-full object-cover object-top"
                         alt="album cover"/>
                    <div class="mt-3 py-2">
                        <h3 class="mb-3 font-medium">{{ item.title }}</h3>
                        <p class="text-xs text-gray-500 font-bold">{{ $filters.dateFormat(item.release_date) }}</p>
                    </div>

                    <div class="absolute bottom-24 left-2">
                        <span
                            class="bg-primary-light text-primary text-xs font-medium  px-2.5 py-1 rounded-lg">
                            {{ item.songs_count }} songs
                        </span>
                    </div>
                </div>
            </div>
            <div v-else>
                <div class="flex justify-center items-center h-64">
                    <!--                create a callout component-->
                    <div class="flex flex-col justify-center items-center">
                        <p class="text-gray-500 text-sm">
                            No albums found for you !
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <div>
            <div class="mb-4 flex items-center justify-between">
                <h1 class="text-2xl font-bold text-primary">
                    New Releases
                </h1>
                <router-link to="/songs" class="text-sm text-primary font-bold inline-flex items-center">
                    See All
                    <IconChevronRight/>
                </router-link>
            </div>
            <div class="grid md:grid-cols-4 grid-cols-1 gap-4 md:gap-8" v-if="songs.length">
                <div v-for="item in songs"
                     class="rounded-lg hover:opacity-60 <!--bg-primary-light/20 p-3--> cursor-pointer relative">
                    <img :src="item.album.cover_image_url" class="rounded-lg h-44 object-cover w-full object-top"
                         alt="album cover"/>
                    <div class="mt-3 py-2">
                        <h3 class="mb-3 font-medium">{{ item.title }}</h3>
                        <p class="text-xs text-gray-500 font-bold">{{ item.duration }}</p>
                    </div>

                </div>
            </div>
            <div v-else>
                <div class="flex justify-center items-center h-64">
                    <!--                create a callout component-->
                    <div class="flex flex-col justify-center items-center">
                        <p class="text-gray-500 text-sm">
                            No songs found for you !
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</template>



