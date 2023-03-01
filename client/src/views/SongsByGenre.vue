<script setup>
import {onMounted, ref} from "vue";

import http from "../config/axiosClient.js";

import SongCard from "../components/SongCard.vue";
import router from "../router/index.js";

let songs = ref([]);

// get genre slug from route params
let genreSlug = router.currentRoute.value.params.slug;
let genre = ref({});
let fetchGenre = () => {

    http.get('/genres/' + genreSlug)

        .then((response) => {
            genre.value = response.data.data;
        })

        .catch((error) => {
            console.log(error);
        });
}
let fetchSongs = () => {

    http.get('/songs/genre/' + genreSlug)

        .then((response) => {
            songs.value = response.data.data;
        })

        .catch((error) => {
            console.log(error);
        });

}

onMounted(() => {
    fetchGenre();
    fetchSongs();
});


</script>


<template>
    <div>
        <h1 v-if="genre">
            Songs by <strong>{{ genre.name }}</strong> genre
        </h1>

        <div class="" v-if="songs.length">
            <SongCard v-for="item in songs" class="rounded-lg hover:opacity-60 cursor-pointer relative"
                      :item="item"/>
        </div>
    </div>
</template>
