<script setup>
  import { ref, onMounted } from 'vue'
  import axios from 'axios';
import Post from '../components/Post.vue';

  const data = ref(null);

  onMounted(async () => {
    const response = await axios.get('http://localhost:8080/myforum/api/posts?page=1');
    data.value = response.data['hydra:member'];
    console.log(data.value)
  });
</script>

<template>
  <main>
    <h1>Home</h1>
    <Post v-for="post in data" :post="post" />
</main>
</template>
