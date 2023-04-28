<script setup>
    import { computed, ref } from "vue";
    import { RouterLink, RouterView } from 'vue-router'
    import { onMounted } from "vue";
    import {useUserStore} from "./stores/users.js";

    const userStore = useUserStore();

    const current = computed(() => userStore?.getCurrentUser);

    onMounted(() => {
        userStore.fetchUsers();
    })
</script>

<template>
    <header>
        <nav class="font-Poppins flex flex-row justify-between items-center px-12 py-5 shadow-[0_0_80px_rgba(0,0,0,.07)]">
            <RouterLink class="block text-black font-bold text-3xl" to="/"><span class="text-vert text-4xl">F</span>orum</RouterLink>
            <ul class="flex flex-row justify-around w-6/12">
                <li><RouterLink class="nav_li_a" to="/">Accueil</RouterLink></li>
                <li v-if="current"><RouterLink class="nav_li_a" :to="'/statistiques/' + current.id">Statistiques</RouterLink></li>
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
