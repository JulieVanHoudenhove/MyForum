<script setup>
// import axios from 'axios';

// const register = () => {
//   axios.post('http://localhost:8000/api/register/', {
//     'username': document.getElementById('pseudo').value,
//     'password': document.getElementById('mdp').value,
//     'email': document.getElementById('email').value,
//   })
//   .then((response) => {
//     response.status == 201 ? checkCredentials : null;
//     }
//   )
// }

// const checkCredentials = async () => {
//     const response = await axios.post('http://localhost:8000/api/login_check', {
//         "username": document.getElementById('pseudo').value,
//         "password": document.getElementById('mdp').value
//     })

//     .then((response) => {
//         localStorage.setItem('token', response.data.token);
//         window.location.href = '/';
//     })
//     .catch((error) => {
//         if (error.request.status === 401) {
//             document.getElementById('error').innerHTML = 'Identifiants incorrects';
//         }
//     })
 
// }
</script>

<template>
<main class=" mt-20 flex flex-col items-center justify-center font-Poppins">
    <h1 class="h1 text-vert">Créez votre compte</h1>
    <form @submit.prevent="register" class="flex flex-col items-center justify-center">
      <div class="flex flex-col m-4 w-80">
        <label class="mb-2" for="email">Email</label>
        <input id="email" class="py-2.5 px-5 bg-gris_input text-gris_text border-gris_input rounded-lg" type="email" placeholder="client@email.com" required>
      </div>
      <div  class="flex flex-col m-4 w-80">
        <label class="mb-2" for="pseudo">Pseudo</label>
        <input id="pseudo" class="py-2.5 px-5 bg-gris_input text-gris_text border-gris_input rounded-lg" type="text" placeholder="pseudo" required>
      </div>
      <div  class="flex flex-col m-4 w-80">
        <label class="mb-2" for="mdp">Mot de passe</label>
        <input id="password" class="py-2.5 px-5 bg-gris_input text-gris_text border-gris_input rounded-lg" type="text" placeholder="****" required>
      </div>
      <div  class="flex flex-col m-4 w-80">
        <label class="mb-2" for="confirm_mdp">Confirmation du mot de passe</label>
        <input id="password_confirm" class="py-2.5 px-5 bg-gris_input text-gris_text border-gris_input rounded-lg" type="text" placeholder="****" required>
      </div>
      <div class="flex flex-row-reverse justify-around m-4 w-80">
        <label for="terms">Accepter les conditions d'utilisation</label>
        <input type="checkbox" required>
      </div>        
      <p>J'ai déjà un compte, <a class="text-vert" href="/connexion">me connecter</a></p>
      <button type="submit" class="m-5 py-2.5 px-5 bg-vert border-vert border-2 rounded-lg text-white transition duration-300 text-lg hover:bg-transparent hover:text-vert" >S'inscrire</button>
    </form>


</main>
</template>

<style>
</style>
