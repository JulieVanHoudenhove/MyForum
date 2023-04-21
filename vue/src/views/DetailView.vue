<script setup>
    import { useRoute } from 'vue-router'
    const route = useRoute()
    const id = route.params.id
</script>

<template>
    <main class="mt-5 ml-5 font-Poppins">
        <RouterLink class="m-5 text-vert transition duration-3000 decoration-2 hover:underline uppercase font-semibold" to="/"><i class="fa-solid fa-arrow-left"></i> Retour</RouterLink>
        <article class="m-12 px-12 p-5 rounded-lg shadow-[0_0_80px_rgba(0,0,0,.07)]">
            <h3 class="my-5 text-xl font-bold">{{ post.title }}</h3>
            <p class="my-5">{{ post.text }}</p>
            <!--<img class="h-52 my-3.5" src="{{post.image}}" alt="">-->
            <div class="flex flew-row justify-between">
                <p class="text-lg"><span class="text-xs italic">Écrit par : </span>{{ post.user.username }}</p>
                <p>{{ new Date(post.createdAtTimestampable).toLocaleDateString('fr-FR', {'year':'numeric', 'month':'long', 'day':'numeric', 'hour':'numeric', 'minute': 'numeric'}) }}</p>
            </div>
            <div class="flex flex-row-reverse justify-between my-5">
                <RouterLink to="/remove"></RouterLink>
            </div>
        </article>
    </main>
    <div class="statistiques">
      <h1>This is an {{id}} e</h1>
    </div>
  </template>
  
  <style>
  </style>
  