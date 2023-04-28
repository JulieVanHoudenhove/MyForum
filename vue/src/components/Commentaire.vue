<script setup>
import axios from "axios";
 import { computed } from "vue";
import { useCommentStore } from "../stores/comments.js";
    const current = defineProps({
        comment: {
            type: Object,
            required: true
        },
        utilisateur: {
            type: Object,
        }
    })
    const commentStore = useCommentStore();
    const postComment = computed(() => commentStore.getCommentsByPostId(postId.value));
    const deleteComment = () => {
    commentStore.deleteComment(current.comment.id);
    }

    const likeComment = () => {
        axios.post('http://localhost:8000/api/liked_comments', {
            "comment": "/api/comments/"+current.comment.id,
            "user": current.utilisateur['@id']
        })
        .then((response) => {
            commentStore.fetchComments();
            console.log(response);
        })
    }

    const dislikeComment = () => {
        axios.delete('http://localhost:8000/api/liked_comments/'+current.comment.likeId)
        .then((response) => {
            commentStore.fetchComments();
            console.log(response);
        })
    }
</script>

<template>
    <article class=" mr-12 mb-12 ml-12">
        <p class="my-6"><span class="font-semibold">{{ comment.user.username }}</span><br>{{ comment.text }}</p>
        <div class=" flex flex-row justify-between">
            <p>{{ new Date(comment.createdAt).toLocaleDateString('fr-FR', {'year':'numeric', 'month':'long', 'day':'numeric', 'hour':'numeric', 'minute': 'numeric'}) }}</p>
            <div v-if="current" class="w-20 flex flex-row justify-between text-vert ">
                <div class="w-12 flex flex-row justify-around">
                    <button v-if="comment.isLiked" @click="dislikeComment"><i class="fa-solid fa-heart"></i></button>
                    <button v-else @click="likeComment"><i class="fa-regular fa-heart"></i></button>
                    <p>{{ comment.likes}}</p>
                </div>
                <!-- <RouterLink v-if="current.utilisateur && comment.user.id == current.utilisateur.id" class="text-vert" :to="'/removecom/' +comment.id"><i class="fa-solid fa-trash"></i></RouterLink> -->
                <button v-if="current.utilisateur && comment.user.id == current.utilisateur.id" class="text-vert" @click="deleteComment"><i class="fa-solid fa-trash"></i></button>
            </div>
            <div v-if="!current" class="w-12 flex flex-row justify-around text-vert mb-5">
                <RouterLink to="/connexion"><i class="fa-regular fa-heart"></i></RouterLink>
                <p>{{ comment.likes }}</p>
            </div>
        </div>
    </article>
</template>

<style scoped>
</style>