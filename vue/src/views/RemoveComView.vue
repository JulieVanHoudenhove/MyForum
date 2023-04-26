<script setup>
  import axios from 'axios';
  import { useRoute } from 'vue-router';

  const route = useRoute();
  const id = route.params.id;

  await axios.delete('http://localhost:8000/api/comments/'+id)
    .then ((response) => {
      if (response.status == 204) {
        window.history.go(-1);
      }
    })
    .catch ((error) => {
      console.log(error);
    })
</script>

<template>
</template>

<style>
</style>
