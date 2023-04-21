<script setup>
    import { useRoute } from 'vue-router'
    const route = useRoute()
    const id = route.params.id
</script>

<template>
    <div class="statistiques">
      <h1>This is an {{id}} e</h1>
    </div>
  </template>
  
  <style>
  </style>
  