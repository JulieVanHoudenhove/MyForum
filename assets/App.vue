<template>
    <Nav />
    <Banniere />
</template>

<script setup>
import { onMounted } from 'vue';

import Nav from './controllers/Nav.vue';
import Banniere from './controllers/Banniere.vue'

    onMounted(() => {
        console.log('hello world')
    })
</script>