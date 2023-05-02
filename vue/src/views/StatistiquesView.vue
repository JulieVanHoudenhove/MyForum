<script setup>
    import axios from 'axios';
    import { onMounted, ref } from 'vue';
    import { useRoute } from 'vue-router'
    import GraphUser from '../components/GraphUser.vue';
    import GraphLike from '../components/GraphLike.vue';
    import api from '../stores/api';

    const route = useRoute()

    const id = route.params.id

    const current = defineProps({ utilisateur: { type: Object }})

    const stats = ref(null);
        onMounted(async () => {
            const response = await api.get('user_stats/'+id);
            stats.value = response.data;
            console.log(stats.value)
        });
</script>

<template>
    <!-- <div v-if="stats">
        <div v-for="activeUser in stats.mostActiveUsers">
            {{ activeUser.username }}, Total de  {{ activeUser.posts.length  }} posts <br>
        </div>
        <div v-for="week in stats.likesPerWeek">
            {{ week['1'] }} likes, semaine n°{{ week.w }}
        </div>
    </div> -->
<main v-if="stats" class="mt-20 font-Poppins flex flex-col justify-center items-center">
    <h1 class="h1 text-vert">Statistiques</h1>
    <div class="grid grid-cols-2 gap-x-10 gap-y-10 text-center justify-center items-center m-12">
        <section class="py-5 w-80 transition duration-300 hover:bg-white hover:border-0 hover:shadow-[0_40px_80px_rgba(49,49,49,.1)] px-12 p-5 rounded-lg shadow-[0_0_80px_rgba(0,0,0,.07)]">
            <!-- nombre total de post de l'utilisateur -->
            <h2 class="text-2xl font-bold">{{ stats.totalPost }}</h2>
            <p>{{ stats.totalPost > 1 ? 'Posts' : 'Post' }}</p>
        </section>
        <section class="py-5 w-80 transition duration-300 hover:bg-white hover:border-0 hover:shadow-[0_40px_80px_rgba(49,49,49,.1)] px-12 p-5 rounded-lg shadow-[0_0_80px_rgba(0,0,0,.07)]">
            <!-- nombre total de likes tous les posts de l'utilisateur -->
            <h2 class="text-2xl font-bold">{{ stats.totalLike }}</h2>
            <p>{{ stats.totalLike > 1 ? 'Likes' : 'Like' }}</p>
        </section>
        <section class="py-5 w-80 transition duration-300 hover:bg-white hover:border-0 hover:shadow-[0_40px_80px_rgba(49,49,49,.1)] px-12 p-5 rounded-lg shadow-[0_0_80px_rgba(0,0,0,.07)]">
            <!-- nombre de posts fait depuis 7 jours -->
            <h2 class="text-2xl font-bold">{{ stats.lastWeekPost }}</h2>
            <p>Posts des <br>7 derniers jours</p>
        </section>
        <section class="py-5 w-80 transition duration-300 hover:bg-white hover:border-0 hover:shadow-[0_40px_80px_rgba(49,49,49,.1)] px-12 p-5 rounded-lg shadow-[0_0_80px_rgba(0,0,0,.07)]">
            <!-- nombre de likes sur les posts depuis 7 jours -->
            <h2 class="text-2xl font-bold">{{ stats.lastWeekLike }}</h2>
            <p>Likes des <br>7 derniers jours</p>
        </section>
        <GraphUser v-if="stats" :users="stats.mostActiveUsers" />
        <GraphLike v-if="stats" :users="stats.likesPerWeek" />
    </div>
</main>
</template>

<style>
</style>
