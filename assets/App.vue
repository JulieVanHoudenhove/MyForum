<template>
    <Statistique />
</template>

<script setup>
import { onMounted } from 'vue';

import Statistique from './controllers/Statistique.vue'

    onMounted(() => {
        console.log('hello world')
    })
</script>