<script setup>
    import Post from '../components/Post.vue';
    import { ref, onMounted, computed } from "vue";
    import { usePostStore } from "../stores/posts.js";
    // import axios from 'axios';

    // const data = ref(null);

    // onMounted(async () => {
    // const response = await axios.get('http://localhost:8000/api/posts?page=1');
    // data.value = response.data['hydra:member'];
    // console.log(data.value)
    // });
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

    const store = usePostStore();
    const posts = computed(() => {
        return store.posts;
    });
    onMounted(() => {
        store.fetchPosts();
    });
</script>

<template>
    <main class="font-Poppins">
        <div class="w-full p-64 flex justify-center items-center bg-vert">
            <h1 class="text-white text-4xl font-bold">My Forum</h1>
        </div>
        <section class="flex items-start w-full flex-col">
            <h2 class="m-14 font-bold text-2xl">Fil d'actualité</h2>
            <RouterLink v-if="current" class="ml-20 m-5 py-2.5 px-5 bg-vert border-vert border-2 rounded-lg text-white transition duration-300 text-lg hover:bg-transparent hover:text-vert" to="/create">Créer un post</RouterLink>
            <!-- POST     -->
            <article v-for="post in posts" :key="post.id" class=" mr-12 mb-12 ml-20 w-11/12  px-12 p-5 rounded-lg shadow-[0_0_80px_rgba(0,0,0,.07)]">
                <RouterLink class=" mx-12" :to="'/details/' + post.id">
                    <h3 class="text-xl font-bold">{{ post.title }}</h3>
                    <p class="my-5">{{ post.text }}</p>
                    <img v-if="post.img" class="h-52 my-3.5" src="{{post.img}}" alt="">
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
        </section>
    </main>
</template>
