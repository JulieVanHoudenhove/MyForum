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

  // const current = ref();

  // const parseJwt = (token) => {
  //     var base64Url = token.split('.')[1];
  //     var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
  //     var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
  //         return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
  //     }).join(''));

  //     return JSON.parse(jsonPayload);
  // }

  // if (localStorage.getItem('token')) {
  //     current.value = parseJwt(localStorage.getItem('token'));
  //     console.log(parseJwt(localStorage.getItem('token')))
  // }
</script>

<template>
  <main v-if="users" class="mt-20 flex flex-col items-center justify-center font-Poppins">
    <h1 class="h1 text-vert">Votre compte</h1>
    <section class="m-12 flex flex-col items-center justify-center bg-gris_input p-7 rounded-xl  w-1/2">
      <Compte :users = users />
      <div class="flex flex-col items-center p-7">
        <h3 class="text-xl font-bold">Mot de passe</h3>
        <RouterLink v-if="current && current.id == users.id" class="text-vert transition duration-300 hover:underline decoration-2" :to="'/editpassword/' + users.id">Changer de mot de passe</RouterLink>
      </div>
      <RouterLink class="m-4 px-5 py-2.5 bg-vert border-vert border-2 rounded-lg  text-white transition duration-300 text-md hover:bg-transparent hover:text-vert" :to="'/statistiques' + users.id">Accéder à mes statistiques</RouterLink>
    </section>
  </main>
</template>
