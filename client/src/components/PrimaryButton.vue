<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit'
    },
});
</script>

<template>
    <button :type="type"
            class="inline-flex items-center justify-center px-5 py-2.5 bg-primary border border-transparent rounded-md font-semibold  text-white  hover:bg-primary-dark focus:bg-primary-dark  focus:outline-none focus:ring-2 focus:ring-primary-dark focus:ring-offset-2 transition ease-in-out duration-150">
        <slot/>
    </button>
</template>
