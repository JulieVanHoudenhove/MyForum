<script setup>
import {ref} from'vue'
    import axios from "axios";
    import { usePostStore } from "../stores/posts.js";
    import api from "../stores/api";
    const store = usePostStore();
    const current = 
    defineProps({
        post: {
            type: Object,
            required: true
        },
        utilisateur: {
            type: Object,
        }
    })

    const handleEdit = () => {
        isEditing.value = true;
    }

    const likePost = () => {
        api.post('liked_posts', {
            "post": "/api/posts/"+current.post.id,
            "user": current.utilisateur['@id']
        })
        .then((response) => {
            store.fetchPostsLike();
            console.log(response);
        })
    }

    const dislikePost = () => {
        api.delete('liked_posts/'+current.post.likeId)
        .then((response) => {
            store.fetchPostsLike();
            console.log(response);
        })
    }
</script>

<template>
    <!-- v-for="post in posts" :key="post.id"  -->
    <article class=" mr-12 mb-12 ml-20 w-11/12  px-12 p-5 rounded-lg shadow-[0_0_80px_rgba(0,0,0,.07)]">
        <RouterLink class=" mx-12" :to="{name: 'post', params: {id: post.id}}">
            <h3 class="text-xl font-bold">{{ post.title }}</h3>
            <p class="my-5">{{ post.text }}</p>
            <img v-if="post.image" class="h-52 my-3.5"  :src="post.image" alt="">
            <div class="flex flew-row justify-between">
                <p class="text-lg"><span class="text-xs italic">Écrit par : </span>{{ post.user.username }}</p>
                <p>{{ new Date(post.createdAt).toLocaleDateString('fr-FR', {'year':'numeric', 'month':'long', 'day':'numeric', 'hour':'numeric', 'minute': 'numeric'}) }}</p>
            </div>
        </RouterLink>
        <div v-if="current.utilisateur" class="w-12 flex flex-row justify-around text-vert mb-5">
            <button v-if="post.isLiked" @click="dislikePost"><i class="fa-solid fa-heart"></i></button>
            <button v-else @click="likePost"><i class="fa-regular fa-heart"></i></button>
            <p>{{ post.likes }}</p>
        </div>
        <div v-if="!current.utilisateur" class="w-12 flex flex-row justify-around text-vert mb-5">
            <RouterLink to="/connexion"><i class="fa-regular fa-heart"></i></RouterLink>
            <p>{{ post.likes }}</p>
        </div>
    </article>
</template>

<style scoped>
</style>