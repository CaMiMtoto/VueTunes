<template>
    <div>
       <div class="flex gap-3 items-center justify-center">
           <router-link to="/genres">Genres</router-link>
           <router-link to="/albums">Albums</router-link>
           <router-link to="/songs">Songs</router-link>
       </div>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: "AppLayout"
}
</script>

<style scoped>

</style>
