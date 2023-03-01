<script setup>

import {onMounted, ref} from "vue";

import http from "../config/axiosClient.js";

import AlbumCard from "../components/AlbumCard.vue";

let albums = ref([]);

let fetchAlbums = () => {

    http.get('/albums/all')

        .then((response) => {

            albums.value = response.data.data;

        })

        .catch((error) => {

            console.log(error);

        });

}

onMounted(() => {

    fetchAlbums();

});


</script>
<template>
    <div>
        <h1  class="mb-4 font-bold">
            Albums
        </h1>

        <div class="grid md:grid-cols-4 grid-cols-1 gap-3 md:gap-8" v-if="albums.length">
            <AlbumCard v-for="item in albums" class="rounded-lg hover:opacity-60 cursor-pointer relative"
                       :item="item"/>
        </div>
    </div>
</template>
