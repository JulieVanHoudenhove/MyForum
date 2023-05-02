<script setup>
    // import Post from '../components/Post.vue';
    // import {useGetPostsQuery} from '../hooks/post.js';
    // import { ref, onMounted, computed } from "vue";
    // import { usePostStore } from "../stores/posts.js";

    // const current = defineProps({utilisateur: {type: Object}})

    // const store = usePostStore();
    // const postIsLoading = computed(() => store.isLoading);
    // const posts = computed(() => {
    //     return store.posts;
    // });
    // onMounted(() => {
    //     store.fetchPosts();
    // });

    // -------------------------------------------------------------------

    // const { isLoading, isError, data: posts, error } = useGetPostsQuery();

</script>

<template>
    <!-- <span v-if="isLoading" class="flex justify-center items-center transition duration-300">
        <div class="spinner spinner-1 w-full"></div>
    </span>
    <span v-else-if="isError">Error: {{ error.message }}</span> -->
    <main class="font-Poppins">
        <div class="w-full p-64 flex justify-center items-center bg-vert">
            <h1 class="text-white text-4xl font-bold">My Forum</h1>
        </div>
        <div class="flex items-start w-full flex-col">
            <h2 class="m-14 font-bold text-2xl">Bienvenue sur My Forum</h2>
            <p class="m-14">Vous pouvez poster, liker et commenter sur tous les posts de vos amis et sur tous les sujets qui vous plaisent</p>
            <RouterLink class="ml-20 m-5 py-2.5 px-5 bg-vert border-vert border-2 rounded-lg text-white transition duration-300 text-lg hover:bg-transparent hover:text-vert" to="/posts">Voir tous les posts</RouterLink>
        </div>
    </main>
</template>
