<script setup>
    import { reactive, computed } from "vue";
    import { useLogStore } from "../stores/connexion.js";

    const logStore = useLogStore();
    // const postIsLoading = computed(() => store.isLoading);
    const logs = computed(() => {
        return logStore.logs;
    });

    const fields = reactive({
    username: '',
    password: '',
    })

    const checkCredentials = () => {
        logStore.checkCredentials(fields);
    }
</script>

<template>
<main class=" mt-20 flex flex-col items-center justify-center font-Poppins">
    <form @submit.prevent="checkCredentials" class="flex flex-col items-center justify-center">
        <!-- <div class="alert alert-danger">{{ error.messageKey|trans(error.messageData, 'security') }}</div>
        <div class="mb-3">
            You are logged in as {{ app.user.userIdentifier }}, <a href="/deconnexion">Deconnexion</a>
        </div> -->
        <h1 class="h1 text-vert">Connectez-vous</h1>
        <div id="error"></div>
        <div class="flex flex-col m-4 w-80">
            <label class="mb-2" for="inputUsername">Pseudo</label>
            <input v-model="fields.username" class=" py-2.5 px-5 bg-gris_input text-gris_text border-gris_input rounded-lg" type="text" name="username" id="inputUsername" autocomplete="username" required autofocus placeholder="pseudo">
        </div>
        <div class="flex flex-col m-4 w-80">
            <label class="mb-2" for="inputPassword">Mot de passe</label>
            <input v-model="fields.password" class="form-control py-2.5 px-5 bg-gris_input text-gris_text border-gris_input rounded-lg" type="password" name="password" id="inputPassword" autocomplete="current-password" required placeholder="****">
        </div>
        <p>Je n'ai pas de compte, <a class="text-vert" href="/inscription">m'inscrire</a></p>

        <input type="hidden" name="_csrf_token"
            value="{{ csrf_token('authenticate') }}"
        >
        <button class="m-5 py-2.5 px-5 bg-vert border-vert border-2 rounded-lg text-white transition duration-300 text-lg hover:bg-transparent hover:text-vert" type="submit">Connexion</button>
    </form>
</main>
</template>

<style>
</style>
