<script setup>
import {
    IconPlaylist,
} from '@tabler/icons-vue';
import {onMounted, ref} from "vue";
import http from "../config/axiosClient.js";

let genres = ref([]);

let fetchGenres = () => {
    http.get('/genres/all')
        .then((response) => {
            genres.value = response.data.data;
        })
        .catch((error) => {
            console.log(error);
        });
}

onMounted(() => {
    fetchGenres();
});


</script>

<template>
    <div>
        <div
            class="w-full shadow-sm p-4 bg-white border border-gray-200 rounded-lg  sm:p-8">
            <div class="flex items-center justify-between mb-4">
                <h5 class="text-xl font-bold leading-none text-gray-900">
                    Genres
                </h5>
            </div>
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    <li v-for="item in genres" class="py-3 sm:py-4 hover:opacity-50">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-8 h-8 rounded-full bg-primary-light text-xs flex items-center justify-center ">
                                    {{ item.name.substring(0, 2).toUpperCase() }}
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    {{ item.name }}
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    {{ item.songs_count }} songs
                                </p>
                            </div>
                            <router-link :to="`/songs/genre/${item.slug}`" v-if="item.songs_count"
                                         class="inline-flex items-center text-sm bg-primary-dark px-3 rounded py-1.5 text-white">
                                <IconPlaylist/>
                                Songs
                            </router-link>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</template>


