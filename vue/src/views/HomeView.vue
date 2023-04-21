<script setup>
  import { ref, onMounted } from 'vue'
  import axios from 'axios';
import Post from '../components/Post.vue';

  const data = ref(null);

  onMounted(async () => {
    const response = await axios.get('http://localhost:8000/api/posts?page=1');
    data.value = response.data['hydra:member'];
    console.log(data.value)
  });
</script>

<template>
    <main class="font-Poppins">
        <div class="w-full p-64 flex justify-center items-center bg-vert">
            <h1 class="text-white text-4xl font-bold">My Forum</h1>
        </div>
        <section class="flex items-start w-full flex-col">
            <h2 class="m-14 font-bold text-2xl">Fil d'actualité</h2>
            <!-- POST     -->
            <Post v-for="post in data" :post="post" />
        </section>
    </main>
</template>
