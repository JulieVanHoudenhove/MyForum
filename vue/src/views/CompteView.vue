<script setup>
  import { ref, onMounted } from 'vue'
  import axios from 'axios';
  import Compte from '../components/Compte.vue';
  import { useRoute } from 'vue-router'
  const route = useRoute()
  const id = route.params.id

  const users = ref(null);

  onMounted(async () => {
    const response = await axios.get('http://localhost:8000/api/users/'+id);
    users.value = response.data;
    console.log(users.value)
  });
</script>

<template>
  <main v-if="users" class="mt-20 flex flex-col items-center justify-center font-Poppins">
    <h1 class="h1 text-vert">Votre compte</h1>
    <section class="m-12 flex flex-col items-center justify-center bg-gris_input p-7 rounded-xl  w-1/2">
      <div class="flex flex-row-reverse items-end p-7 relative">
        <img class="bg-white rounded-full h-32 w-32" src="user.avatar" alt="{{ user.username}} avatar">
        <RouterLink class=" text-xl bg-vert p-2 rounded-full h-10 w-10 pb-2.5 text-center margin_negative absolute" :to="'/editprofil/' + users.id"><i class="fa-solid fa-camera"></i></RouterLink>
    </div>
    <div class="flex flex-row p-7 justify-around w-full">
        <div class="flex flex-col p-7">
          <h3 class="text-xl font-bold">Pseudo</h3>
          <p>{{ users.username }}</p>
        </div>
        <div class="flex flex-col p-7">
          <h3 class="text-xl font-bold">Email</h3>
          <p>{{ users.email }}</p>
        </div>
    </div>
      <div class="flex flex-col items-center p-7">
        <h3 class="text-xl font-bold">Mot de passe</h3>
        <RouterLink class="text-vert transition duration-300 hover:underline decoration-2" :to="'/editpassword' + id">Changer de mot de passe</RouterLink>
      </div>
      <RouterLink class="m-4 px-5 py-2.5 bg-vert border-vert border-2 rounded-lg  text-white transition duration-300 text-md hover:bg-transparent hover:text-vert" :to="'/statistiques' + id">Accéder à mes statistiques</RouterLink>
    </section>
  </main>
</template>
