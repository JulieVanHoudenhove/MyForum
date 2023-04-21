<script setup>
    defineProps({
        post: {
            type: Object,
            required: true
        },
    })
</script>

<template>
    <div>
        <h1>{{ post.title }}</h1>
        <p>{{ post.text }}</p>
        <p>{{ post.user.username }}</p>
        <small>{{ new Date(post.createdAtTimestampable).toLocaleDateString('fr-FR', {'year':'numeric', 'month':'long', 'day':'numeric', 'hour':'numeric', 'minute': 'numeric'}) }}</small>    
    </div>
</template>

<style scoped>
</style>