<template>
    <Nav />
    <Index />
    <Compte />
    <Connexion />
    <Statistique />
    <Inscription />
    <DetailPost />
</template>

<script setup>
import { onMounted } from 'vue';

import Nav from './controllers/Nav.vue'
import Index from './controllers/Index.vue'
import Compte from './controllers/Compte.vue'
import Connexion from './controllers/Connexion.vue'
import Statistique from './controllers/Statistique.vue'
import Inscription from './controllers/Inscription.vue'
import DetailPost from './controllers/DetailPost.vue'


    onMounted(() => {
        console.log('hello world')
    })
</script>