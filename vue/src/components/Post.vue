<script setup>
    defineProps({
        post: {
            type: Object,
            required: true
        },
    })
</script>

<template>
    <RouterLink class="ml-20 m-5 py-2.5 px-5 bg-vert border-vert border-2 rounded-lg text-white transition duration-300 text-lg hover:bg-transparent hover:text-vert" to="/create">Créer un post</RouterLink>
    <article class=" mr-12 mb-12 ml-20 w-11/12  px-12 p-5 rounded-lg shadow-[0_0_80px_rgba(0,0,0,.07)]">
        <RouterLink class=" mx-12" :to="'/details/' + post.id">
            <h3 class="text-xl font-bold">{{ post.title }}</h3>
            <p class="my-5">{{ post.text }}</p>
            <!--<img class="h-52 my-3.5" src="{{post.image}}" alt="">-->
            <div class="flex flew-row justify-between">
                <p class="text-lg"><span class="text-xs italic">Écrit par : </span>{{ post.user.username }}</p>
                <p>{{ new Date(post.createdAt).toLocaleDateString('fr-FR', {'year':'numeric', 'month':'long', 'day':'numeric', 'hour':'numeric', 'minute': 'numeric'}) }}</p>
            </div>
        </RouterLink>
        <div class="w-12 flex flex-row justify-around text-vert mb-5">
            <!-- <RouterLink to="/dislike/:id"><i class="fa-solid fa-heart"></i></RouterLink> -->
            <RouterLink to="/like/:id"><i class="fa-regular fa-heart"></i></RouterLink>
            <p>{{ post.likesPosts|lenght}}</p>
        </div>
        <!-- <div class="w-12 flex flex-row justify-around text-vert mb-5">
            <RouterLink to="/connexion"><i class="fa-regular fa-heart"></i></RouterLink>
            <p>{{ post.likePosts|lenght }}</p>
        </div> -->
    </article>
</template>

<style scoped>
</style>