<script>
   export default {
       name: "compte"
   }
</script>

<template>
    <main class="compte">
        <h1>Votre compte</h1>
        <section>
            <div>
                <Pseudo />
                <Email />
            </div>
            <Mdp />
            <a class="link" href="analytics.html">Accéder à mes statistiques</a>
        </section>
    </main>
</template>

<script setup>
    import Pseudo from './compte/Pseudo.vue'
    import Email from './compte/Email.vue'
    import Mdp from './compte/Mdp.vue'
</script>
<style></style>