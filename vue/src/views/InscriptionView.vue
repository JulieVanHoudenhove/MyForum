<script setup>
    import { reactive, computed } from "vue";
    import { useLogStore } from "../stores/connexion.js";
    import router from "../router";
    import { useUserStore } from "../stores/users.js";
    
    const logStore = useLogStore();

    const userStore = useUserStore();
    // const postIsLoading = computed(() => store.isLoading);
    const logs = computed(() => {
        return logStore.logs;
    });

    const fields = reactive({
      username: '',
      password: '',
      email: '',
    })
    
    const register = () => {
        logStore.Register(fields).then(async (res) => {
            userStore.setTryToLogin(true);
            await router.push('/');
    });
    }


</script>

<template>
<main class=" mt-20 flex flex-col items-center justify-center font-Poppins">
    <h1 class="h1 text-vert">Créez votre compte</h1>
    <form @submit.prevent="register" class="flex flex-col items-center justify-center">
      <div class="flex flex-col m-4 w-80">
        <label class="mb-2" for="email">Email</label>
        <input v-model="fields.email" id="email" class="py-2.5 px-5 bg-gris_input text-gris_text border-gris_input rounded-lg" type="email" placeholder="client@email.com" required>
      </div>
      <div  class="flex flex-col m-4 w-80">
        <label class="mb-2" for="pseudo">Pseudo</label>
        <input v-model="fields.username" id="pseudo" class="py-2.5 px-5 bg-gris_input text-gris_text border-gris_input rounded-lg" type="text" placeholder="pseudo" required>
      </div>
      <div  class="flex flex-col m-4 w-80">
        <label class="mb-2" for="mdp">Mot de passe</label>
        <input v-model="fields.password" id="password" class="py-2.5 px-5 bg-gris_input text-gris_text border-gris_input rounded-lg" type="password" placeholder="****" required>
      </div>
      <div  class="flex flex-col m-4 w-80">
        <label class="mb-2" for="confirm_mdp">Confirmation du mot de passe</label>
        <input id="password_confirm" class="py-2.5 px-5 bg-gris_input text-gris_text border-gris_input rounded-lg" type="password" placeholder="****" required>
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
