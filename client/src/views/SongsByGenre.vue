<script setup>
import {onMounted, ref} from "vue";

import http from "../config/axiosClient.js";

import SongCard from "../components/SongCard.vue";
import {useRoute} from "vue-router";

const route = useRoute();
let songs = ref([]);

// get genre slug from route params
let genre = ref({});
let fetchGenre = (genreSlug) => {

    http.get('/genres/' + genreSlug)

        .then((response) => {
            genre.value = response.data.data;
        })

        .catch((error) => {
            console.log(error);
        });
}
let fetchSongs = (genreSlug) => {

    http.get('/songs/genre/' + genreSlug)

        .then((response) => {
            songs.value = response.data.data;
        })

        .catch((error) => {
            console.log(error);
        });

}

onMounted(() => {
    let genreSlug =route.params.slug;
    fetchGenre(genreSlug);
    fetchSongs(genreSlug);
});


</script>


<template>
    <div>
        <h1 v-if="genre" class="mb-3">
            Songs by <strong>{{ genre.name }}</strong> genre
        </h1>

        <div class="grid sm:grid-cols-2 2xl:grid-cols-3 grid-cols-1 gap-2 md:gap-2 mb-4" v-if="songs.length">
            <div v-for="item in songs">
                <SongCard :item="item"/>
            </div>
        </div>
    </div>
</template>
