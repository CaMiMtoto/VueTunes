<template>
    <router-link :to="to"
                 exact-active-class="bg-primary-light text-primary-dark font-bold"
                 class="flex justify-start items-center gap-2 rounded-full px-4 py-2.5 text-sm  hover:text-primary hover:bg-white">
        <slot></slot>
        <span>{{ text }}</span>
    </router-link>
</template>

<script setup>

defineProps({
    to: {
        type: String,
        required: true
    },
    text: {
        type: String,
        required: true
    }
});


</script>

<style scoped>

</style>
