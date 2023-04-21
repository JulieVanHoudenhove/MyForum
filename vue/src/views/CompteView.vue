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
  <main class="mt-20 flex flex-col items-center justify-center font-Poppins">
    <h1 class="h1 text-vert">Votre compte</h1>
    <section class="m-12 flex flex-col items-center justify-center bg-gris_input p-7 rounded-xl  w-1/2">
      <Compte v-for="user in data" :user="user" />
      <div class="flex flex-col items-center p-7">
        <h3 class="text-xl font-bold">Mot de passe</h3>
        <RouterLink class="text-vert transition duration-300 hover:underline decoration-2" to="/editpassword" + id>Changer de mot de passe</RouterLink>
      </div>
      <RouterLink class="m-4 px-5 py-2.5 bg-vert border-vert border-2 rounded-lg  text-white transition duration-300 text-md hover:bg-transparent hover:text-vert" to="/statistiques" +id>Accéder à mes statistiques</RouterLink>
    </section>
  </main>
</template>
