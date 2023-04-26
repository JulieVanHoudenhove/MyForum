<script setup>
//   import axios from 'axios';
//   import {computed} from 'vue';
//   import { useRoute, useRouter } from 'vue-router';
// import { useCommentStore } from '../stores/comments';

//   const commentStore = useCommentStore();
//   const router = useRouter();
//   const route = useRoute();
//   const id = route.params.id;

//   const post = computed(() => commentStore.getCommentById(id));

  // await axios.delete('http://localhost:8000/api/comments/'+id)
  //   .then ((response) => {
  //     if (response.status == 204) {
  //       router.push({
  //         name: 'detailPost',
  //         params: {
  //           id: post.value.id
  //         }
  //       });
  //     }
  //   })
  //   .catch ((error) => {
  //     console.log(error);
  //   })
</script>

<template>
  {{ post }}
</template>

<style>
</style>
