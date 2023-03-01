<script setup>

import PrimaryButton from "../../components/PrimaryButton.vue";
import TextInput from "../../components/TextInput.vue";
import {onMounted, ref} from "vue";
import http from "../../config/axiosClient.js";
import {IconEdit, IconTrash} from "@tabler/icons-vue";
import PrimaryIconButton from "../../components/common/PrimaryIconButton.vue";
import DangerIconButton from "../../components/common/DangerIconButton.vue";
import SecondaryButton from "../../components/SecondaryButton.vue";
import InputError from "../../components/InputError.vue";
import FormGroup from "../../components/FormGroup.vue";
import InputLabel from "../../components/InputLabel.vue";
import Spinner from "../../components/Spinner.vue";
import Modal from "../../components/common/Modal.vue";
import Pagination from "../../components/common/Pagination.vue";
import Td from "../../components/table/Td.vue";
import Th from "../../components/table/Th.vue";
import Thead from "../../components/table/Thead.vue";
import Table from "../../components/table/Table.vue";
import TextArea from "../../components/TextArea.vue";
import DangerButton from "../../components/DangerButton.vue";

const isOpen = ref(false)
const genres = ref([])
const albums = ref([])

function closeModal() {
    isOpen.value = false
}

function openModal() {
    isOpen.value = true
}

function resetForm() {
    songForm.value.id = '';
    songForm.value.title = '';
    songForm.value.genre_id = '';
    songForm.value.album_id = '';
    songForm.value.length = '';
    songForm.value.loading = false;
    songForm.value.errors = {
        title: [],
        genre_id: [],
        album_id: [],
    };
}

function addNew() {
    resetForm();
    openModal();
}

let pageData = ref({
    songs: [],
    links: {},
    meta: {}
});

const songPreview = ref(null);
const songInput = ref(null);
const songForm = ref({
    id: '',
    title: '',
    genre_id: '',
    album_id: '',
    length:'',
    errors: {
        title: [],
        genre_id: [],
        album_id: [],
    },
    loading: false
});


const deleteItem = (slug) => {

    Swal.fire({
        title: "Are you sure?",
        text: "Do you really want to delete this record ?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            http.delete(`/songs/${slug}`)
                .then(response => {
                    getSongs();
                    Swal.fire(
                        'Deleted!',
                        'Album successfully deleted',
                        'success'
                    )
                })
                .catch(error => {
                    console.log(error);
                });
        }
    })
}


const getSongs = () => {
    fetchSongs('/songs');
}

const fetchSongs = (url) => {
    http.get(url)
        .then(response => {
            const {meta, links, data} = response.data;
            pageData.value.songs = data;
            pageData.value.links = links;
            pageData.value.meta = meta;
        })
        .catch(error => {
            console.log(error);
        });
}

const saveChanges = () => {
    songForm.value.loading = true;
    songForm.value.errors = {
        title: [],
        release_date: [],
        description: [],
    };
    let url = '/songs';

    const formData = new FormData();
    formData.append('title', songForm.value.title);
    formData.append('genre_id', songForm.value.genre_id);
    formData.append('album_id', songForm.value.album_id);
    formData.append('length', songForm.value.length);
    if (songForm.value.id) {
        url = `/songs/${songForm.value.id}`;
        formData.append('_method', 'PUT');
    }

    let promise = http.post(url, formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    });

    promise
        .then(({data}) => {
            resetForm();
            closeModal();
            getSongs();
        })
        .catch(error => {
            songForm.value.loading = false;
            songForm.value.errors = error.response.data.errors;
        });
}

const edit = (item) => {
    songForm.value.id = item.id;
    songForm.value.title = item.title;
    songForm.value.genre_id = item.genre_id;
    songForm.value.album_id = item.album_id;
    songForm.value.length = item.length;
    openModal();
}

let getGenres = () => {
    http.get('/genres/all')
        .then(response => {
            genres.value = response.data.data;
        })
        .catch(error => {
            console.log(error);
        });
}

let getAlbums = () => {
    http.get('/albums/all')
        .then(response => {
            albums.value = response.data.data;
        })
        .catch(error => {
            console.log(error);
        });
}

onMounted(() => {
    getGenres();
    getAlbums();
    getSongs();
});




</script>

<template>
    <div>
        <h1 class="text-xl font-medium mb-2">
            Manage songs
        </h1>
        <div class="mb-2 flex flex-col md:flex-row md:items-center gap-2 justify-between">
            <TextInput id="search" placeholder="Search ..." type="search" class="block"/>
            <primary-button class="btn btn-primary" @click="addNew">
                Add New
            </primary-button>
        </div>

        <div class="relative overflow-x-auto shadow-sm sm:rounded-lg border">
            <Table>
                <Thead>
                <tr>
                    <Th>Title</Th>
                    <Th>Genre</Th>
                    <Th>Album</Th>
                    <Th>Length</Th>
                    <Th></Th>
                </tr>
                </Thead>
                <tbody>
                <tr v-for="item in pageData.songs" class="bg-white border-b">
                    <Td>{{ item.title }}</Td>
                    <Td>{{ item.genre.name }}</Td>
                    <Td>{{ item.album.title }}</Td>
                    <Td>{{ item.duration }}</Td>
                    <Td class="text-right">
                        <div class="flex items-center gap-2">
                            <primary-icon-button @click="edit(item)">
                                <icon-edit class="w-5 h-5"/>
                            </primary-icon-button>
                            <danger-icon-button @click="deleteItem(item.slug)">
                                <icon-trash class="w-5 h-5"/>
                            </danger-icon-button>
                        </div>
                    </Td>
                </tr>
                </tbody>
            </Table>
        </div>


        <pagination :page-data="pageData" @page-changed="fetchSongs"/>


        <modal :is-open="isOpen" title="Album">
            <template #title>
                Song
            </template>

            <template #content>
                <FormGroup>
                    <InputLabel for="title" class="block">
                        Title
                    </InputLabel>
                    <TextInput id="title" v-model="songForm.title"
                               type="text"
                               class="mt-1 block w-full"
                               placeholder="Title"
                    />
                    <InputError v-if="songForm.errors.title" :message="songForm.errors.title[0]"/>
                </FormGroup>
                <FormGroup>
                    <InputLabel for="genre_id" class="block">
                        Genre
                    </InputLabel>
                    <select id="genre_id" v-model="songForm.genre_id"
                            class="border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm mt-1 block w-full">
                        <option v-for="genre in genres" :value="genre.id">{{ genre.name }}</option>
                    </select>
                    <InputError v-if="songForm.errors.genre_id" :message="songForm.errors.genre_id[0]"/>
                </FormGroup>

                <FormGroup>
                    <InputLabel for="album_id" class="block">
                        Album
                    </InputLabel>
                    <select id="album_id" v-model="songForm.album_id"
                            class="border-gray-300 focus:border-primary focus:ring-primary rounded-md shadow-sm mt-1 block w-full">
                        <option v-for="album in albums" :value="album.id">{{ album.title }}</option>
                    </select>
                    <InputError v-if="songForm.errors.album_id" :message="songForm.errors.album_id[0]"/>
                </FormGroup>

                <FormGroup>
                    <InputLabel for="length" class="block">
                        Length
                    </InputLabel>
                    <TextInput id="length" v-model="songForm.length"
                               type="number"
                               class="mt-1 block w-full"
                               placeholder="Length"
                    />
                    <InputError v-if="songForm.errors.length" :message="songForm.errors.length[0]"/>
                </FormGroup>


            </template>
            <template #footer>
                <PrimaryButton @click="saveChanges"
                               class="mr-3 py-1.5" v-bind:disabled="songForm.loading" type="submit">
                    Save Changes
                    <spinner v-if="songForm.loading"/>
                </PrimaryButton>
                <SecondaryButton @click="closeModal">
                    Cancel
                </SecondaryButton>
            </template>
        </modal>


    </div>
</template>


