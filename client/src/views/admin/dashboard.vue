<template>
    <div>
        <h1 class="mb-4 font-bold">
            Dashboard
        </h1>

        <div class="grid md:grid-cols-3 grid-cols-1 gap-3 md:gap-8">
            <div
                class="text-primary-dark rounded-lg  border border-primary-light p-4 h-44 flex items-baseline justify-end flex-col bg-primary-light">
                <h2 class="text-5xl font-bold">
                    {{ homeData.total_songs}}
                </h2>
                <p class="text-primary-dark font-bold mt-5">
                    Total Songs
                </p>
            </div>
            <div
                class="text-indigo-500 rounded-lg  border border-indigo-100 p-4 h-44 flex items-baseline justify-end flex-col bg-indigo-50">
                <h2 class="text-5xl font-bold">
                    {{ homeData.total_albums}}
                </h2>
                <p class="text-indigo-500 font-bold mt-5">
                    Total Albums
                </p>
            </div>



            <div class="text-red-500 rounded-lg  border border-red-100 p-4 h-44 flex items-baseline justify-end flex-col bg-red-50">
                <h2 class="text-5xl font-bold">
                    {{ homeData.total_genres}}
                </h2>
                <p class="text-red-500 font-bold mt-5">
                    Total Genres
                </p>
            </div>

        </div>

        <div class="mt-8">
            <h2 class="mb-4 font-bold">
                Recently Added Songs
            </h2>
            <div v-for="item in songs">
                <SongCard :item="item"/>
            </div>
        </div>

    </div>
</template>

<script setup>
import AlbumCard from "../../components/AlbumCard.vue";
import SongCard from "../../components/SongCard.vue";
import http from "../../config/axiosClient.js";
import {onMounted, ref} from "vue";

let songs = ref([]);
let homeData = ref([]);

let fetchSongs = () => {
    http.get('/songs?per_page=5')
        .then((response) => {
            songs.value = response.data.data;
        })
        .catch((error) => {
            console.log(error);
        });
}
let fetchHomeData = () => {
    http.get('/home')
        .then((response) => {
            homeData.value = response.data;
        })
        .catch((error) => {
            console.log(error);
        });
}

onMounted(() => {
    fetchHomeData();
    fetchSongs();
});

</script>
