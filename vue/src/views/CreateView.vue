<script setup>
//import axios from 'axios';
const current = defineProps({utilisateur: {type: Object}})

import { onMounted, computed } from "vue";
import { usePostStore } from "../stores/posts.js";

const store = usePostStore();
const postIsLoading = computed(() => store.isLoading);
const posts = computed(() => {
    return store.posts;
});

onMounted(() => {
    store.fetchPosts();
    store.createPosts();
    store.deletePosts();
});

// const sendPost = async () => {
//   await axios.post('http://localhost:8000/api/posts', {
//     'title': document.getElementById('titre').value,
//     'text': document.getElementById('contenu').value,
//     'image': document.getElementById('image').value,
//     'user': current.utilisateur['@id']
//   })
//     .then ((response) => {
//         if (response.status === 201) {
//             window.location.href = '/';
//         }
//     })
// }
</script>

<template>
  <main class=" mt-20 flex flex-col items-center justify-center font-Poppins">
    <h1  class="h1 text-vert">Créer un nouveau post</h1>
    <div class="create_post flex flex-col items-center justify-center w-4/5" action="">
      <div class="flex flex-col m-4 w-4/5">
        <label class="mb-2" for="titre">Titre</label>
        <input class="py-2.5 px-5 bg-gris_input text-gris_text border-gris_input rounded-lg" type="text" placeholder="Votre titre..." id="titre">
      </div>
      <div class="flex flex-col m-4 w-4/5">
        <label class="mb-2" for="contenu">Contenu du post</label>
        <textarea class="py-2.5 px-5 bg-gris_input text-gris_text border-gris_input rounded-lg" name="contenu" id="contenu" cols="30" rows="10" placeholder="Contenu de votre post..." ></textarea>
      </div>
      <div class="flex flex-col m-4 w-4/5">
        <label class="mb-2" for="image">Ajouter une image</label>
        <input class="py-2.5 px-5 bg-gris_input text-gris_text border-gris_input rounded-lg" type="file" id="image">
      </div>
      <button @click="createPosts" class="m-5 py-2.5 px-5 bg-vert border-vert border-2 rounded-lg text-white transition duration-300 text-lg hover:bg-transparent hover:text-vert" type="submit" value="Poster">Poster</button>
    </div>
  </main>
</template>
  
<style>
</style>  