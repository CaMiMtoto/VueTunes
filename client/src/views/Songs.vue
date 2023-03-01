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
        <h1>
            Songs
        </h1>

        <div class="" v-if="songs.length">
            <SongCard v-for="item in songs" class="rounded-lg hover:opacity-60 cursor-pointer relative"
                      :item="item"/>
        </div>
    </div>
</template>
