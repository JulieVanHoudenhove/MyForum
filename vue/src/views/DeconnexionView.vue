<script setup>
  if(localStorage.getItem('token')) {
    localStorage.removeItem('token')
    window.location.href = '/'
  } else {
    window.location.href = '/'
  }
</script>

<template>
</template>

<style>
</style>
