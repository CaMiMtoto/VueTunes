<script setup>
import {onMounted, ref} from "vue";

import http from "../config/axiosClient.js";

import SongCard from "../components/SongCard.vue";
import router from "../router/index.js";

let songs = ref([]);

// get genre slug from route params
let slug = router.currentRoute.value.params.slug;
let album = ref({});
let fetchAlbum = () => {

    http.get('/albums/' + slug)

        .then((response) => {
            album.value = response.data.data;
        })

        .catch((error) => {
            console.log(error);
        });
}

let fetchSongs = () => {

    http.get('/songs/album/' + slug)

        .then((response) => {
            songs.value = response.data.data;
        })

        .catch((error) => {
            console.log(error);
        });

}

onMounted(() => {
    fetchAlbum();
    fetchSongs();
});


</script>


<template>
    <div>
        <h1 v-if="album">
            Songs by <strong>{{ album.title }}</strong> album
        </h1>

        <div class="" v-if="songs.length">
            <SongCard v-for="item in songs" class="rounded-lg hover:opacity-60 cursor-pointer relative"
                      :item="item"/>
        </div>
    </div>
</template>
