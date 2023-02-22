<script setup>

import PrimaryButton from "../../components/PrimaryButton.vue";
import TextInput from "../../components/TextInput.vue";
import {inject, onMounted, ref} from "vue";
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

const isOpen = ref(false)

function closeModal() {
    isOpen.value = false
}

function openModal() {
    isOpen.value = true
}

function addNew() {
    genreForm.value.id = '';
    genreForm.value.name = '';
    openModal();
}

let pageData = ref({
    genres: [],
    links: {},
    meta: {}
});
const genreForm = ref({
    id: '',
    name: '',
    errors: {
        name: []
    },
    loading: false
});


const deleteGenre = (slug) => {

    Swal.fire({
        title: "Are you sure?",
        text: "Do you really want to delete this record ?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            http.delete(`/genres/${slug}`)
                .then(response => {
                    getGenres();
                    Swal.fire(
                        'Deleted!',
                        'Genre successfully deleted',
                        'success'
                    )
                })
                .catch(error => {
                    console.log(error);
                });

        }
    })
}


const getGenres = () => {
    fetchGenres('/genres');
}

const fetchGenres = (url) => {
    http.get(url)
        .then(response => {
            const {meta, links, data} = response.data;
            pageData.value.genres = data;
            pageData.value.links = links;
            pageData.value.meta = meta;
        })
        .catch(error => {
            console.log(error);
        });
}

const saveChanges = () => {
    genreForm.value.loading = true;
    let url = '/genres';
    http.post(url, genreForm.value)
        .then(({data}) => {
            genreForm.value.loading = false;
            genreForm.value.name = '';
            closeModal();
            getGenres();
        })
        .catch(error => {
            genreForm.value.loading = false;
            genreForm.value.errors = error.response.data.errors;
        });
}

const edit = (item) => {
    genreForm.value.id = item.id;
    genreForm.value.name = item.name;
    openModal();
}

onMounted(() => {
    getGenres();
});


</script>

<template>
    <div>
        <h1 class="text-xl font-medium mb-2">
            Manage Genres
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
                    <Th>
                        Name
                    </Th>
                    <Th>
                        <div class="flex items-center">
                            Created At
                        </div>
                    </Th>
                    <Th>
                        <div class="flex items-center">
                            Songs
                        </div>
                    </Th>

                    <Th>
                        <span class="sr-only"></span>
                    </Th>
                </tr>
                </Thead>
                <tbody>
                <tr v-for="item in pageData.genres" class="bg-white border-b">
                    <Td>
                        {{ item.name }}
                    </Td>
                    <Td>
                        {{ $filters.dateFormat(item.created_at) }}
                    </Td>
                    <Td>
                        {{ item.songs_count }}
                    </Td>
                    <Td class="text-right">
                        <div class="flex items-center gap-2">
                            <primary-icon-button @click="edit(item)">
                                <icon-edit class="w-5 h-5"/>
                            </primary-icon-button>
                            <danger-icon-button @click="deleteGenre(item.slug)">
                                <icon-trash class="w-5 h-5"/>
                            </danger-icon-button>
                        </div>
                    </Td>
                </tr>
                </tbody>
            </Table>
        </div>


        <pagination :page-data="pageData" @page-changed="fetchGenres"/>


        <modal :is-open="isOpen" title="Genre">
            <template #title>
                Genre
            </template>

            <template #content>
                <FormGroup>
                    <InputLabel for="name" class="block">
                        Name
                    </InputLabel>
                    <TextInput id="name" v-model="genreForm.name"
                               type="text"
                               class="mt-1 block w-full"
                               placeholder="Name"
                    />
                    <InputError v-if="genreForm.errors.name" :message="genreForm.errors.name[0]"/>
                </FormGroup>
            </template>
            <template #footer>
                <PrimaryButton @click="saveChanges"
                               class="mr-3 py-1.5" v-bind:disabled="genreForm.loading" type="submit">
                    Save Changes
                    <spinner v-if="genreForm.loading"/>
                </PrimaryButton>
                <SecondaryButton @click="closeModal">
                    Cancel
                </SecondaryButton>
            </template>
        </modal>


    </div>
</template>


