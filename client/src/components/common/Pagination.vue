<template>
    <div class="flex flex-col lg:flex-row justify-between items-center mt-4" v-if="pageData.meta">
        <!-- Help text -->
        <div class="text-sm text-gray-700 dark:text-gray-400">
            Showing <span class="font-semibold text-gray-900 dark:text-white">{{ pageData.meta.from }}</span>to<span
            class="font-semibold text-gray-900 dark:text-white"> {{ pageData.meta.to }}</span> of <span
            class="font-semibold text-gray-900 dark:text-white"> {{ pageData.meta.total }}</span> Entries
        </div>

        <div class="inline-flex mt-2 xs:mt-0" v-if="pageData.links">
            <!-- Buttons -->
            <button @click="fetchGenres(pageData.links.prev)"
                    :disabled="!pageData.links.prev"
                    :class="{'cursor-not-allowed opacity-50': !pageData.links.prev}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary rounded-l hover:bg-primary-dark">
                <svg aria-hidden="true" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                          clip-rule="evenodd"></path>
                </svg>
                Prev
            </button>
            <button
                @click="fetchGenres(pageData.links.next)"
                :disabled="!pageData.links.next"
                :class="{'cursor-not-allowed opacity-50': !pageData.links.next}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary border-0 border-l border-gray-700 rounded-r hover:bg-primary-dark">
                Next
                <svg aria-hidden="true" class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>
</template>

<script setup>
defineProps({
    pageData: {}
})

const emit = defineEmits(['pageChanged']);

const fetchGenres = (url) => {
    emit('pageChanged', url);
}


</script>

<style scoped>

</style>
