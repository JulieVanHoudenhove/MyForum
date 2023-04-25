<script setup>
    import axios from 'axios';
    import Commentaire from '../components/Commentaire.vue';
    import { ref, onMounted, computed } from "vue";
    import { usePostDetailStore } from "../stores/posts_detail.js";

    //const post = ref(null);
    const coms = ref(null);
    import { useRoute } from 'vue-router'
    const route = useRoute()
    const id = route.params.id

    onMounted(async () => {
    //const response = await axios.get('http://localhost:8000/api/posts/'+id);
    const responsecom = await axios.get('http://localhost:8000/api/comments?page=1&post='+id);
    //post.value = await response.data;
    //console.log(post.value)
    coms.value = await responsecom.data['hydra:member'];
    console.log(coms.value)
  });

    const store = usePostDetailStore();
    const posts_detail = computed(() => {
        return store.posts_detail;
    });
    onMounted(() => {
        store.fetchPostsDetail();
    });

    console.log(posts_detail.value)

  const current = ref();

    const parseJwt = (token) => {
        var base64Url = token.split('.')[1];
        var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));

        return JSON.parse(jsonPayload);
    }

    if (localStorage.getItem('token')) {
        current.value = parseJwt(localStorage.getItem('token'));
        console.log(parseJwt(localStorage.getItem('token')))
    }
</script>

<template>
    <main v-if="post" class="mt-5 ml-5 font-Poppins">
        <RouterLink class="m-5 text-vert transition duration-3000 decoration-2 hover:underline uppercase font-semibold" to="/"><i class="fa-solid fa-arrow-left"></i> Retour</RouterLink>
        <article class="m-12 px-12 p-5 rounded-lg shadow-[0_0_80px_rgba(0,0,0,.07)]">
            <h3 class="my-5 text-xl font-bold">{{ posts.title }}</h3>
            <p class="my-5">{{ posts.text }}</p>
            <img v-if="posts.img" class="h-52 my-3.5" src="{{posts.img}}" alt="">
            <div class="flex flew-row justify-between">
                <p class="text-lg"><span class="text-xs italic">Écrit par : </span>{{ }}</p>
                <p>{{ new Date(posts.createdAt).toLocaleDateString('fr-FR', {'year':'numeric', 'month':'long', 'day':'numeric', 'hour':'numeric', 'minute': 'numeric'}) }}</p>
            </div>
            <div class="flex flex-row-reverse justify-between my-5">
                <RouterLink v-if="current && posts == current.id" class="text-vert" to="/remove/:id"><i class="fa-solid fa-trash"></i></RouterLink>
            </div>
            <div v-if="current" class="w-12 flex flex-row justify-around text-vert">
                <!-- <RouterLink to="/dislike/:id"><i class="fa-solid fa-heart"></i></RouterLink> -->
                <RouterLink to="/like/:id"><i class="fa-regular fa-heart"></i></RouterLink>
                <p>{{ posts.likes }}</p>
            </div>
            <div v-else="!current" class="w-12 flex flex-row justify-around text-vert mb-5">
                <RouterLink to="/connexion"><i class="fa-regular fa-heart"></i></RouterLink>
                <p>{{ posts.likes }}</p>
            </div>
        </article>
        <article>
            <section class="mx-12 my-14 ">
                <h3 class="my-5 text-xl font-bold">Commentaires</h3>
                <input v-if="current" class="mx-12 w-2/4 py-2.5 px-5 bg-gris_input text-gris_text border-gris_input rounded-lg" type="text" placeholder="Votre commentaire...">
                <button v-if="current" class="m-5 py-2.5 px-5 bg-vert border-vert border-2 rounded-lg text-white transition duration-300 text-mg hover:bg-transparent hover:text-vert">Envoyer</button>
                <Commentaire v-if="coms" v-for="com in coms" :comment="com" />
            </section>
        </article>
    </main>
  </template>
  
  <style>
  </style>
  