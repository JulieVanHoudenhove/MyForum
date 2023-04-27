<script setup>
import { ref } from "vue";
import { RouterLink, RouterView } from 'vue-router'
import { onMounted } from "vue";



import {useUserStore} from "./stores/users.js";

const userStore = useUserStore();

//const current = computed(() => userStore.getCurrentUser());

onMounted(() => {
    userStore.fetchUsers();
})

const current = ref();

const parseJwt = (token) => {
    var base64Url = token.split('.')[1];
    var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));

    return JSON.parse(jsonPayload);
}

if (localStorage.getItem('token')) {
    current.value = parseJwt(localStorage.getItem('token'));
    console.log(parseJwt(localStorage.getItem('token')))
}
</script>

<template>
    <header>
        <nav class="font-Poppins flex flex-row justify-between items-center px-12 py-5 shadow-[0_0_80px_rgba(0,0,0,.07)]">
            <RouterLink class="block text-black font-bold text-3xl" to="/"><span class="text-vert text-4xl">F</span>orum</RouterLink>
            <ul class="flex flex-row justify-around w-6/12">
                <li><RouterLink class="nav_li_a" to="/">Accueil</RouterLink></li>
                <li v-if="current"><RouterLink class="nav_li_a" to="/statistiques">Statistiques</RouterLink></li>
                <li v-if="current"><RouterLink class="nav_li_a" :to="'/compte/' + current.id">Compte</RouterLink></li>
                <li v-if="current"><RouterLink class="nav_li_a" to="/deconnexion">Déconnexion</RouterLink></li>
                <li v-if="!current"><RouterLink class="nav_li_a" to="/inscription">Inscription</RouterLink></li>
                <li v-if="!current"><RouterLink class="nav_li_a" to="/connexion">Connexion</RouterLink></li>
            </ul>
        </nav>
    </header>
    
    <RouterView :utilisateur="current"/>
</template>
<style scoped>

</style>
