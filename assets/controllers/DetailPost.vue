<script>
   export default {
       name: "detail_post"
   }
</script>

<template>
    <main class="post">
        <article>
            <h3>Post 2</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos quae pariatur doloribus cumque distinctio! Sint numquam nam quas, asperiores optio neque veniam itaque, magnam possimus quia incidunt natus unde commodi.</p>
            <div>
                <p><span>Écrit par :</span> Pseudo 2</p>
                <p>17/04/2023 16:03</p>
            </div>
            <div class="react">
                <i class="fa-regular fa-comment"></i>
                <i class="fa-regular fa-heart"></i>
            </div>
        </article>
        <Commentaire />
    </main>
</template>

<script setup>
    import Commentaire from './Commentaire.vue'
</script>

<style></style>