<script setup>
import {onMounted, ref} from "vue";

import http from "../config/axiosClient.js";

import SongCard from "../components/SongCard.vue";
import {useRoute} from "vue-router";
const route = useRoute();

let songs = ref([]);

// get genre slug from route params

let album = ref({});
let fetchAlbum = (slug) => {

    http.get('/albums/' + slug)

        .then((response) => {
            album.value = response.data.data;
        })

        .catch((error) => {
            console.log(error);
        });
}

let fetchSongs = (slug) => {

    http.get('/songs/album/' + slug)

        .then((response) => {
            songs.value = response.data.data;
        })

        .catch((error) => {
            console.log(error);
        });

}

onMounted(() => {
    let slug =route.params.slug;
    fetchAlbum(slug);
    fetchSongs(slug);
});


</script>


<template>
    <div>
        <h1 v-if="album" class="mb-3">
            Songs by <strong>{{ album.title }}</strong> album
        </h1>

        <div class="grid md:grid-cols-2 2xl:grid-cols-3 grid-cols-1 gap-2 md:gap-2 mb-4" v-if="songs.length">
            <div v-for="item in songs">
                <SongCard :item="item"/>
            </div>
        </div>
    </div>
</template>
