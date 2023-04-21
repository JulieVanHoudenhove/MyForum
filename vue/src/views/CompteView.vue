<script setup>
  import { ref, onMounted } from 'vue'
  import axios from 'axios';
  import Compte from '../components/Compte.vue';

  const data = ref(null);

  onMounted(async () => {
    const response = await axios.get('http://localhost:8000/api/users/' +id);
    data.value = response.data;
    console.log(data.value)
  });
</script>

<template>
  <Compte v-for="user in data" :user="user" />
</template>
