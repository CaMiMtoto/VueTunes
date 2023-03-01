<script setup>
import {onMounted, ref} from "vue";

import http from "../config/axiosClient.js";

import SongCard from "../components/SongCard.vue";

let songs = ref([]);

let fetchSongs = () => {

    http.get('/songs/all')

        .then((response) => {
            songs.value = response.data.data;
        })

        .catch((error) => {
            console.log(error);
        });

}

onMounted(() => {
    fetchSongs();
});


</script>


<template>
    <div>
        <h1 class="mb-4 font-bold">Songs</h1>

        <div class="grid md:grid-cols-2 grid-cols-1 gap-2 md:gap-2 mb-4" v-if="songs.length">
            <div v-for="item in songs">
                <SongCard :item="item"/>
            </div>
        </div>
    </div>
</template>
