<script setup>
  import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <header>
    <nav class="font-Poppins flex flex-row justify-between items-center px-12 py-5 shadow-[0_0_80px_rgba(0,0,0,.07)]">
        <RouterLink class="block text-black font-bold text-3xl" to="/"><span class="text-vert text-4xl">F</span>orum</RouterLink>
        <ul class="flex flex-row justify-around w-6/12">
            <li><RouterLink class="nav_li_a" to="/">Accueil</RouterLink></li>
                <li><RouterLink class="nav_li_a" to="/statistiques">Statistiques</RouterLink></li>
                <li><RouterLink class="nav_li_a" :to="'/compte/' + id">Compte</RouterLink></li>
                <li><RouterLink class="nav_li_a" to="/deconnexion">Déconnexion</RouterLink></li>
                <!-- <li><RouterLink class="nav_li_a" to="/inscription">Inscription</RouterLink></li>
                <li><RouterLink class="nav_li_a" to="/connexion">Connexion</RouterLink> 
                </li>-->
        </ul>
    </nav>
</header>
  <RouterView />
</template>
<style scoped>

</style>
