<template>
    <guest-layout title="Create account" subtitle="Create your account to get started">
        <form class="w-full" @submit.prevent="onSubmit">
            <FormGroup>
                <InputLabel for="name" value="Name"/>
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="block w-full"
                    autofocus
                    autocomplete="name"
                />
                <InputError v-if="form.errors.name" class="mt-2" :message="form.errors.name[0]"/>

            </FormGroup>
            <FormGroup>
                <InputLabel for="email" value="Email"/>
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="block w-full"
                    autocomplete="email"
                />
                <InputError v-if="form.errors.email" class="mt-2" :message="form.errors.email[0]"/>

            </FormGroup>
            <FormGroup>
                <InputLabel for="password" value="Password"/>
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="block w-full"
                    autocomplete="current-password"
                />
                <InputError v-if="form.errors.password" class="mt-2" :message="form.errors.password[0]"/>

            </FormGroup>
            <FormGroup>
                <InputLabel for="password" value="Password Confirmation"/>
                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="block w-full"
                />
                <InputError v-if="form.errors.password_confirmation" class="mt-2"
                            :message="form.errors.password_confirmation[0]"/>

            </FormGroup>

            <PrimaryButton type="submit" class="w-full">
                Sign Up
            </PrimaryButton>

            <div class="mt-6 text-center">
                <p class="text-sm font-medium text-gray-900 dark:text-gray-300">
                    Already have an account?
                    <router-link to="/login"
                                 class="text-primary hover:text-blue-800 dark:text-blue-300 dark:hover:text-blue-400">
                        Sign in
                    </router-link>
                </p>
            </div>


        </form>
    </guest-layout>
</template>

<script setup>

import FormGroup from "../../components/FormGroup.vue";
import InputError from "../../components/InputError.vue";
import TextInput from "../../components/TextInput.vue";
import InputLabel from "../../components/InputLabel.vue";
import {ref} from "vue";
import PrimaryButton from "../../components/PrimaryButton.vue";
import GuestLayout from "../../components/Layouts/GuestLayout.vue";
import {useAuth} from "../../stores/auth.js";

const authStore = useAuth();
import router from "../../router/index.js";

const form = ref({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    errors: {
        name: [],
        email: [],
        password: [],
        password_confirmation: [],
    },
    loading: false
});

const onSubmit = () => {
    form.value.loading = true;

    authStore.register(form.value)
        .then(() => {
            form.value.loading = false;
            router.push('/dashboard');
        })
        .catch((error) => {
            form.value.errors = error.response.data.errors;
            form.value.loading = false;
        });

}

</script>

