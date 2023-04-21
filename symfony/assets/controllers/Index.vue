<script>
   export default {
       name: "index"
   }
</script>

<template>
    <main class="index">
        <Banniere />
        <section>
            <h2>Fil d'actualité</h2>
            <Post />
            <Post />
        </section>
    </main>
</template>

<script setup>
    import Banniere from './index/Banniere.vue'
    import Post from './index/Post.vue'
</script>
<style></style> 