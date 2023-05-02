<script setup>
    import Post from '../components/Post.vue';
    import {useGetPostsQuery} from '../hooks/post.js';
    import CreatePost from '../components/CreatePost.vue';
    // import { ref, onMounted, computed } from "vue";
    // import { usePostStore } from "../stores/posts.js";

    const current = defineProps({utilisateur: {type: Object}})

    // const store = usePostStore();
    // const postIsLoading = computed(() => store.isLoading);
    // const posts = computed(() => {
    //     return store.posts;
    // });
    // onMounted(() => {
    //     store.fetchPosts();
    // });

    // -------------------------------------------------------------------

    const { isLoading, isError, data: posts, error } = useGetPostsQuery();
    console.log('posts',posts);
    console.log('posts _object',posts._object)
    console.log('posts _object data',posts._object.data)
</script>

<template>
    <CreatePost />  
    <template v-if="$route.name === 'posts'">
        <span v-if="isLoading" class="flex justify-center items-center transition duration-300">
            <div class="spinner spinner-1 w-full"></div>
        </span>
        <span v-else-if="isError">Error: {{ error.message }}</span>
        <section v-else-if="posts.data.length" class="flex items-start w-full flex-col">
            <h2 class="m-14 font-bold text-2xl">Fil d'actualité</h2>
            <RouterLink v-if="current" class="ml-20 m-5 py-2.5 px-5 bg-vert border-vert border-2 rounded-lg text-white transition duration-300 text-lg hover:bg-transparent hover:text-vert" to="/create">Créer un post</RouterLink>
            <!-- POST  -->

            <template v-if="posts?.data && posts.data?.length">
                <Post v-for="post in posts.data" :post="post" :key="post.id" :utilisateur="current.utilisateur" />
            </template>
        </section>
    </template>

    <router-view v-else />
</template>

<style>
</style>
