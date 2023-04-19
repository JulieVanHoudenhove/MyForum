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
            <img src="https://images.unsplash.com/photo-1481349518771-20055b2a7b24?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8cmFuZG9tfGVufDB8fDB8fA%3D%3D&w=1000&q=80" alt="">
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