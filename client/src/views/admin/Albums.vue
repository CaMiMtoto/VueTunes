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

function closeModal() {
    isOpen.value = false
}

function openModal() {
    isOpen.value = true
}

function resetForm() {
    albumForm.value.id = '';
    albumForm.value.title = '';
    albumForm.value.release_date = '';
    albumForm.value.cover_image = null;
    albumForm.value.description = '';
    albumForm.value.loading = false;
    albumForm.value.errors = {
        title: [],
        release_date: [],
        cover_image: [],
        description: [],
    };

    photoPreview.value = null;
    clearPhotoFileInput();

}

function addNew() {
    resetForm();
    openModal();
}

let pageData = ref({
    albums: [],
    links: {},
    meta: {}
});

const photoPreview = ref(null);
const photoInput = ref(null);
const albumForm = ref({
    id: '',
    title: '',
    release_date: '',
    cover_image: null,
    description: '',
    errors: {
        title: [],
        release_date: [],
        cover_image: [],
        description: [],
    },
    loading: false
});


const deleteAlbum = (slug) => {

    Swal.fire({
        title: "Are you sure?",
        text: "Do you really want to delete this record ?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            http.delete(`/albums/${slug}`)
                .then(response => {
                    getAlbums();
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


const getAlbums = () => {
    fetchAlbums('/albums');
}

const fetchAlbums = (url) => {
    http.get(url)
        .then(response => {
            const {meta, links, data} = response.data;
            pageData.value.albums = data;
            pageData.value.links = links;
            pageData.value.meta = meta;
        })
        .catch(error => {
            console.log(error);
        });
}

const saveChanges = () => {
    albumForm.value.loading = true;
    albumForm.value.errors = {
        title: [],
        release_date: [],
        cover_image: [],
        description: [],
    };
    let url = '/albums';

    const formData = new FormData();
    formData.append('title', albumForm.value.title);
    formData.append('release_date', albumForm.value.release_date);
    formData.append('cover_image', photoInput.value.files[0] ?? '');
    formData.append('description', albumForm.value.description);

    if (albumForm.value.id) {
        url = `/albums/${albumForm.value.id}`;
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
            getAlbums();
        })
        .catch(error => {
            albumForm.value.loading = false;
            albumForm.value.errors = error.response.data.errors;
        });
}

const edit = (item) => {
    albumForm.value.id = item.id;
    albumForm.value.title = item.title;
    albumForm.value.release_date = item.release_date;
    albumForm.value.description = item.description;

    openModal();
}

onMounted(() => {
    getAlbums();
});


const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (!photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const selectNewPhoto = () => {
    photoInput.value.click();
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};
const deletePhoto = () => {
    photoPreview.value = null;
    clearPhotoFileInput();
};

</script>

<template>
    <div>

        <div class="mb-2 flex flex-col md:flex-row md:items-center gap-2 justify-between">
            <h1 class="text-xl font-medium">
                Manage Albums
            </h1>
            <primary-button class="btn btn-primary" @click="addNew">
                Add New
            </primary-button>
        </div>

        <div class="relative overflow-x-auto shadow-sm sm:rounded-lg border">
            <Table>
                <Thead>
                <tr>
                    <Th>
                        Cover
                    </Th>
                    <Th>
                        Title
                    </Th>
                    <Th>
                        <div class="flex items-center">
                            Release date
                        </div>
                    </Th>

                    <Th>
                        <span class="sr-only"></span>
                    </Th>
                </tr>
                </Thead>
                <tbody>
                <tr v-for="item in pageData.albums" class="bg-white border-b">
                    <Td>
                        <img :src="item.cover_image_url" class="w-10 h-10 rounded-full">
                    </Td>
                    <Td>
                        {{ item.title }}
                    </Td>
                    <Td>
                        {{ $filters.dateFormat(item.release_date) }}
                    </Td>

                    <Td class="text-right">
                        <div class="flex items-center gap-2">
                            <primary-icon-button @click="edit(item)">
                                <icon-edit class="w-5 h-5"/>
                            </primary-icon-button>
                            <danger-icon-button @click="deleteAlbum(item.slug)">
                                <icon-trash class="w-5 h-5"/>
                            </danger-icon-button>
                        </div>
                    </Td>
                </tr>
                </tbody>
            </Table>
        </div>


        <pagination :page-data="pageData" @page-changed="fetchAlbums"/>


        <modal :is-open="isOpen" title="Album">
            <template #title>
                Album
            </template>

            <template #content>
                <FormGroup>
                    <div class="flex gap-2 items-center">
                        <div v-show="photoPreview" class="mt-2">
                            <span
                                class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                                :style="'background-image: url(\'' + photoPreview + '\');'"
                            />
                        </div>

                        <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                            Select A Cover Image
                        </SecondaryButton>

                        <DangerButton
                            v-if="photoPreview"
                            type="button"
                            class="mt-2"
                            @click.prevent="deletePhoto"
                        >
                            Remove Photo
                        </DangerButton>
                        <input
                            ref="photoInput"
                            type="file"
                            class="hidden"
                            @change="updatePhotoPreview"
                        >
                    </div>
                    <InputError v-if="albumForm.errors.cover_image" :message="albumForm.errors.cover_image[0]"/>

                </FormGroup>
                <FormGroup>
                    <InputLabel for="title" class="block">
                        Title
                    </InputLabel>
                    <TextInput id="title" v-model="albumForm.title"
                               type="text"
                               class="mt-1 block w-full"
                               placeholder="Title"
                    />
                    <InputError v-if="albumForm.errors.title" :message="albumForm.errors.title[0]"/>
                </FormGroup>
                <FormGroup>
                    <InputLabel for="release_date" class="block">
                        Release date
                    </InputLabel>
                    <TextInput id="title" v-model="albumForm.release_date"
                               type="date"
                               class="mt-1 block w-full"
                               placeholder="Release date"
                    />
                    <InputError v-if="albumForm.errors.release_date" :message="albumForm.errors.release_date[0]"/>
                </FormGroup>
                <FormGroup>
                    <InputLabel for="description" class="block">
                        Description
                    </InputLabel>
                    <text-area id="description" v-model="albumForm.description"
                               type="date"
                               class="mt-1 block w-full"
                               placeholder="Description">
                    </text-area>
                    <InputError v-if="albumForm.errors.description" :message="albumForm.errors.description[0]"/>
                </FormGroup>
            </template>
            <template #footer>
                <PrimaryButton @click="saveChanges"
                               class="mr-3 py-1.5" v-bind:disabled="albumForm.loading" type="submit">
                    Save Changes
                    <spinner v-if="albumForm.loading"/>
                </PrimaryButton>
                <SecondaryButton @click="closeModal">
                    Cancel
                </SecondaryButton>
            </template>
        </modal>


    </div>
</template>


