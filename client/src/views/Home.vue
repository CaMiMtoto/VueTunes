<script setup>
import {IconChevronRight, IconPlayerPlayFilled} from "@tabler/icons-vue"
import {onMounted, ref} from "vue";
import http from "../config/axiosClient.js";
import AlbumCard from "../components/AlbumCard.vue";
import SongCard from "../components/SongCard.vue";

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

let fetchSongs = () => {
    http.get('/songs?per_page=6')
        .then((response) => {

            songs.value = response.data.data;
        })
        .catch((error) => {
            console.log(error);
        });
}

onMounted(() => {
    fetchAlbums();

    fetchSongs();
});


</script>

<template>
    <div class="flex flex-col gap-4">
        <div>
            <div class="mb-4 flex items-center justify-between">
                <h1 class="text-2xl font-bold text-primary">
                    New Albums
                </h1>
                <router-link to="/albums" class="text-sm text-primary font-bold inline-flex items-center">
                    See All
                    <IconChevronRight/>
                </router-link>
            </div>
            <div class="grid md:grid-cols-4 2xl:grid-cols-6 grid-cols-1 gap-3 md:gap-8" v-if="albums.length">
                <AlbumCard v-for="item in albums" class="rounded-lg hover:opacity-60 cursor-pointer relative"
                           :item="item"/>
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


            <div class="grid md:grid-cols-2 2xl:grid-cols-3 grid-cols-1 gap-2 md:gap-2 mb-4" v-if="songs.length">
                <div v-for="item in songs">
                    <SongCard :item="item"/>
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



