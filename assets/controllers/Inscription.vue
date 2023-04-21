<script>
   export default {
       name: "inscription"
   }
</script>

<template>
    <main class="inscription">

        <form action="">
            <h1>Créez votre compte</h1>
            <Email />
            <Pseudo />
            <Mdp />
            <Terms />
            <p>J'ai déjà un compte, <a href="connexion.html">me connecter</a></p>
            <button>Inscription</button>
        </form>
    </main>
</template>

<script setup>
    import Email from './inscription/Email.vue'
    import Pseudo from './inscription/Pseudo.vue'
    import Mdp from './inscription/Mdp.vue'
    import Terms from './inscription/Terms.vue'
</script>
<style></style>