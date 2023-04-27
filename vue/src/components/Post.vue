<script setup>
    defineProps({
        post: {
            type: Object,
            required: true
        },
    })
</script>

<template>
    <!-- v-for="post in posts" :key="post.id"  -->
    <article class=" mr-12 mb-12 ml-20 w-11/12  px-12 p-5 rounded-lg shadow-[0_0_80px_rgba(0,0,0,.07)]">
        <RouterLink class=" mx-12" :to="{name: 'details', params: {id: post.id}}">
            <h3 class="text-xl font-bold">{{ post.title }}</h3>
            <p class="my-5">{{ post.text }}</p>
            <img v-if="post.image" class="h-52 my-3.5"  :src="post.image" alt="">
            <div class="flex flew-row justify-between">
                <p class="text-lg"><span class="text-xs italic">Écrit par : </span>{{ post.user.username }}</p>
                <p>{{ new Date(post.createdAt).toLocaleDateString('fr-FR', {'year':'numeric', 'month':'long', 'day':'numeric', 'hour':'numeric', 'minute': 'numeric'}) }}</p>
            </div>
        </RouterLink>
        <div v-if="current" class="w-12 flex flex-row justify-around text-vert mb-5">
            <!-- <RouterLink :to="'/dislike/' +id"><i class="fa-solid fa-heart"></i></RouterLink> -->
            <RouterLink :to="'/like/' + id"><i class="fa-regular fa-heart"></i></RouterLink>
            <p>{{ post.likes }}</p>
        </div>
        <div v-if="!current" class="w-12 flex flex-row justify-around text-vert mb-5">
            <RouterLink to="/connexion"><i class="fa-regular fa-heart"></i></RouterLink>
            <p>{{ post.likes }}</p>
        </div>
    </article>
</template>

<style scoped>
</style>