<template>
    <router-link :to="to"
                 active-class="text-primary bg-white"
                 class="flex justify-start items-center gap-2 rounded-md px-4 py-2.5 text-sm font-medium">
        <slot></slot>
        <span>{{ text }}</span>
    </router-link>
</template>

<script setup>
import {useRoute} from "vue-router";

const props = defineProps({
    to: {
        type: String,
        required: true
    },
    text: {
        type: String,
        required: true
    }
});

let isActive = () => {
    // get the current route
    const route = useRoute();
    // check if the current route is the same as the route prop
    return route.path === props.to;
}


</script>

<style scoped>

</style>
