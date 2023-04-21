<script>
   export default {
       name: "statistique"
   }
</script>

<template>
    <main class="statistique">
        <h1>Statistiques</h1>
        <div class="stat">
            <TotalPost />
            <TotalLike />
            <PostSem />
            <LikeSem />
            <Graph />
        </div>
    </main>
</template>

<script setup>
    import Graph from './statistique/GraphUser.vue'
    import LikeSem from './statistique/LikeSem.vue'
    import PostSem from './statistique/PostSem.vue'
    import TotalPost from './statistique/TotalPost.vue'
    import TotalLike from './statistique/TotalLike.vue'
</script>
<style></style>