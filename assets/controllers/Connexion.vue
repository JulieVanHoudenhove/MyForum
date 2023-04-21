<script>
   export default {
       name: "connexion"
   }
</script>

<template>
    <main class="connexion">
        <form action="">
            <h1>Connectez-vous</h1>
            <Email_Pseudo />
            <Mdp />
            <p>Je n'ai pas de compte, <a href="inscription.html">m'inscrire</a></p>
            <button>Connexion</button>
        </form>
    </main>
</template>

<script setup>
    import Email_Pseudo from './connexion/Email_Pseudo.vue'
    import Mdp from './connexion/Mdp.vue'
</script>
<style></style>