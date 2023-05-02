<script setup>
import { computed } from 'vue'
import router from '../router';

const current = defineProps({utilisateur: {type: Object}})

// console.log('current',current)

// import { onMounted, computed, reactive } from "vue";
// import { usePostStore } from "../stores/posts.js";  

// const store = usePostStore();
// const postIsLoading = computed(() => store.isLoading);
// const posts = computed(() => {
//     return store.posts;
// });

const fields = computed(() => ({
    title: '',
    text: '',
    user: current.utilisateur?.id,
    file: null,
}));

const handleInputChange = (e) => {
  fields.value.file = e.target.files[0];
}

// onMounted(() => {
//     store.fetchPosts();
// });

// const createPost = () => {
//   store.createPost({fields}).then(async (res) => {
//     await router.push('/');
//   });
// }

// -------------------------------------------------------------------
import { useCreatePostMutation } from "../hooks/post.js"; //

const handleSubmit = () => {
  const formData = new FormData();

  Object.entries(fields.value).forEach(([key, value]) => {
      formData.append(key, value); 
  });

  mutate(formData, {

      onSuccess: async (res) => {
        console.log('res',res)
          await router.push('/');

      },
  });
}

const { isLoading, isError, error, isSuccess, mutate } = useCreatePostMutation()
</script>

<template>
  <main class=" mt-20 flex flex-col items-center justify-center font-Poppins">
    <h1  class="h1 text-vert">Créer un nouveau post</h1>
    <form @submit.prevent="handleSubmit" class="create_post flex flex-col items-center justify-center w-4/5" action="">
      <div class="flex flex-col m-4 w-4/5">
        <label class="mb-2" for="titre">Titre</label>
        <input v-model="fields.title" class="py-2.5 px-5 bg-gris_input text-gris_text border-gris_input rounded-lg" type="text" placeholder="Votre titre..." id="titre">
      </div>
      <div class="flex flex-col m-4 w-4/5">
        <label class="mb-2" for="contenu">Contenu du post</label>
        <textarea v-model="fields.text" class="py-2.5 px-5 bg-gris_input text-gris_text border-gris_input rounded-lg" name="contenu" id="contenu" cols="30" rows="10" placeholder="Contenu de votre post..." ></textarea>
      </div>
      <div class="flex flex-col m-4 w-4/5">
        <label class="mb-2" for="image">Ajouter une image</label>
        <input @change="handleInputChange" class="py-2.5 px-5 bg-gris_input text-gris_text border-gris_input rounded-lg" type="file" id="image">
      </div>
      <button class="m-5 py-2.5 px-5 bg-vert border-vert border-2 rounded-lg text-white transition duration-300 text-lg hover:bg-transparent hover:text-vert" type="submit" value="Poster">Poster</button>
    </form>
  </main>
</template>
  
<style>
</style>  