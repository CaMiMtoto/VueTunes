<template>
    <guest-layout title="Sign In" subtitle="Sign in to your account">
        <form class="w-full" @submit.prevent="onSubmit">

            <FormGroup>
                <InputLabel for="email" value="Email"/>
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="block w-full"
                    autofocus
                    autocomplete="username"
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
                <label class="flex items-center">
                    <Checkbox v-model:checked="form.remember" name="remember"/>
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </FormGroup>

            <PrimaryButton type="submit" class="w-full gap-2" v-bind:disabled="form.loading">
                Sign In
                <spinner v-if="form.loading"/>
            </PrimaryButton>


            <div class="mt-6 text-center">
                <p class="text-sm font-medium text-gray-900 dark:text-gray-300">
                    Don't have an account?
                    <router-link to="/register"
                                 class="text-primary hover:text-blue-800 dark:text-blue-300 dark:hover:text-blue-400">
                        Sign up
                    </router-link>
                </p>
            </div>

        </form>
    </guest-layout>
</template>

<script setup>

import FormGroup from "../../components/FormGroup.vue";
import {ref} from "vue";
import TextInput from "../../components/TextInput.vue";
import InputLabel from "../../components/InputLabel.vue";
import InputError from "../../components/InputError.vue";
import Checkbox from "../../components/Checkbox.vue";
import PrimaryButton from "../../components/PrimaryButton.vue";
import GuestLayout from "../../components/Layouts/GuestLayout.vue";
import Spinner from "../../components/Spinner.vue";
import {useAuth} from "../../stores/auth.js";
const authStore = useAuth();
import router from "../../router/index.js";

let defaultErrors = {
    email: [],
    password: []
};
const form = ref({
    email: '',
    password: '',
    remember: false,
    errors: defaultErrors,
    loading: false
});

const onSubmit = () => {
    form.value.loading = true;

    authStore.login(form.value)
        .then(response => {
            form.value.loading = false;
            router.push({name: 'admin.dashboard'});
        })
        .catch(error => {
            form.value.loading = false;
            form.value.errors = error.response.data.errors;
        });


}


</script>

