<script>
   export default {
       name: "new_post"
   }
</script>

<template>
    <main class="new_post">
        <h1>Créer un nouveau post</h1>
        <form class="create_post" action="">
            <Titre />
            <Contenu />
            <Image />
            <button>Poster</button>
        </form>
    </main>
</template>

<script setup>
    import Titre from '../new_post/Titre.vue'
    import Contenu from '../new_post/Contenu.vue'
    import Image from '../new_post/Image.vue'
</script>
<style></style>