<script setup>
    import { reactive, computed } from "vue";
    import { useUserStore } from "../stores/users.js";

    const current = defineProps({utilisateur: {type: Object}})

    const userStore = useUserStore();
    // const postIsLoading = computed(() => store.isLoading);
    const users = computed(() => {
        return userStore.users;
    });

    const fields = reactive({
    currentPassword: '',
    password: '',
    })

    const changePassword = () => {
        userStore.changePassword(fields);
    }
        // import axios from 'axios';

        // const current = defineProps({ utilisateur: { type: Object }})

        // const changePassword = () => {
        // axios.put('http://localhost:8000/api/change-password/'+current.utilisateur.id, {
        //     'currentPassword': document.getElementById('currentPassword').value,
        //     'password': document.getElementById('plainPassword').value,
        // })
        // .then((response) => {
        //     console.log(response);
        // })
        // }


</script>

<template>
    <main class=" mt-20 flex flex-col items-center justify-center font-Poppins">
        <h1 class="h1 text-vert">Changez votre mot de passe</h1>
        <form @submit.prevent="changePassword" class="flex flex-col items-center justify-center p-7">
            <div class="flex flex-col m-4 w-80">
                <label class="mb-2" for="mdp_actuel">Mot de passe actuel</label>
                <input v-model="fields.currentPassword" id="currentPassword" class="py-2.5 px-5 bg-gris_input text-gris_text border-gris_input rounded-lg" type="password" placeholder="****">
            </div>
            <div class="flex flex-col m-4 w-80">
                <label class="mb-2" for="new_mdp">nouveau mot de passe</label>
                <input v-model="fields.password" id="plainPassword" class="py-2.5 px-5 bg-gris_input text-gris_text border-gris_input rounded-lg" type="password" placeholder="****">
            </div>
            <div class="flex flex-col m-4 w-80">
                <label class="mb-2" for="new_mdp_repeat">Répétez nouveau mot de passe</label>
                <input class="py-2.5 px-5 bg-gris_input text-gris_text border-gris_input rounded-lg" type="password" placeholder="****">
            </div>
            <button class="m-5 py-2.5 px-5 bg-vert border-vert border-2 rounded-lg text-white transition duration-300 text-lg hover:bg-transparent hover:text-vert" type="submit">Changer mot de passe</button>
        </form>
    </main>
</template>
  
<style>
</style>