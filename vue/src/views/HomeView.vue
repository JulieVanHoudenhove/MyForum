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
        console.log('hello world')
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
            <Post v-for="item in posts" :post="item" :key="item.id" />
        </section>
    </main>
</template>
