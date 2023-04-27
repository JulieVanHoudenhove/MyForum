<script setup>
    import Commentaire from '../components/Commentaire.vue';
    import { useCommentStore } from "../stores/comments.js";
    import { usePostStore } from "../stores/posts.js";
    import { onMounted, computed, reactive } from "vue";
    import { useRoute } from 'vue-router'
    import router from '../router';

    const route = useRoute();
    const postId = computed(() => Number(route?.params?.id))

    const store = usePostStore();
    const commentStore = useCommentStore();
    const commentIsLoading = computed(() => commentStore.isLoading);

    const post = computed(() => store.getPostById(postId.value));
    const postComment = computed(() => commentStore.getCommentsByPostId(postId.value));

    onMounted(() => {
        store.fetchPosts();
        commentStore.fetchComments();
    })

    const current = defineProps({utilisateur: {type: Object}})

    const deletePost = () => {
        store.deletePost(postId.value).then(async (res) => {
            await router.push('/');
        });
    }

    const fields = reactive({
        text: '',
        post: "/api/posts/"+postId.value,
        user: current.utilisateur ? current.utilisateur['@id'] : null
    })

    const createComment = () => {
        commentStore.createComment(fields).then((res) => {
            console.log('HELLO WORLD', res);
        });
    }
</script>

<template>   
    <main v-if="post" class="mt-5 ml-5 font-Poppins transition duration-300">
        <RouterLink class="m-5 text-vert transition duration-3000 decoration-2 hover:underline uppercase font-semibold" to="/"><i class="fa-solid fa-arrow-left"></i> Retour</RouterLink>
        <article class="m-12 px-12 p-5 rounded-lg shadow-[0_0_80px_rgba(0,0,0,.07)]">
            <h3 class="my-5 text-xl font-bold">{{ post.title }}</h3>
            <p class="my-5">{{ post.text }}</p>
            <img v-if="post.image" class="h-52 my-3.5" :src="post.image" alt="">
            <div class="flex flew-row justify-between">
                <p class="text-lg"><span class="text-xs italic">Écrit par : </span>{{ post.user.username}}</p>
                <p>{{ new Date(post.createdAt).toLocaleDateString('fr-FR', {'year':'numeric', 'month':'long', 'day':'numeric', 'hour':'numeric', 'minute': 'numeric'}) }}</p>
            </div>
            <div class="flex flex-row-reverse justify-between my-5">
                <!-- <RouterLink v-if="current.utilisateur && post.user.id == current.utilisateur.id" class="text-vert" :to="'/remove/'+post.id"><i class="fa-solid fa-trash"></i></RouterLink> -->
                <button @click="deletePost" v-if="current.utilisateur && post.user.id == current.utilisateur.id" class="text-vert"><i class="fa-solid fa-trash"></i></button>
            </div>
            <div v-if="current" class="w-12 flex flex-row justify-around text-vert">
                <!-- <RouterLink to="/dislike/:id"><i class="fa-solid fa-heart"></i></RouterLink> -->
                <RouterLink to="/like/:id"><i class="fa-regular fa-heart"></i></RouterLink>
                <p>{{ post.likes }}</p>
            </div>
            <div v-else="!current" class="w-12 flex flex-row justify-around text-vert mb-5">
                <RouterLink to="/connexion"><i class="fa-regular fa-heart"></i></RouterLink>
                <p>{{ post.likes }}</p>
            </div>
        </article>
        <article>
            <section class="mx-12 my-14 ">
                <h3 class="my-5 text-xl font-bold">Commentaires</h3>
                <form v-if="current.utilisateur" @submit.prevent="createComment">
                    <input v-model="fields.text" class="mx-12 w-2/4 py-2.5 px-5 bg-gris_input text-gris_text border-gris_input rounded-lg" id="text" type="text" placeholder="Votre commentaire..." required>
                    <button class="m-5 py-2.5 px-5 bg-vert border-vert border-2 rounded-lg text-white transition duration-300 text-mg hover:bg-transparent hover:text-vert">Envoyer</button>
                </form>
                <template class="flex justify-center items-center transition duration-300" v-if="commentIsLoading">
                    <div class="spinner spinner-1"></div>
                </template> 
                <Commentaire v-else v-if="postComment" v-for="comment in postComment" :comment="comment" :key="comment.id" :utilisateur="current.utilisateur"/>
            </section>
        </article>
    </main>
  </template>
  
  <style>
  </style>
  