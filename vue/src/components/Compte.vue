<script setup>
    defineProps({
        users: {
            type: Object,
            required: true
        },
    })
</script>

<template>
    <div class="flex flex-row-reverse items-end p-7 relative">
        <img class="bg-white rounded-full h-32 w-32" :src="user.avatar" alt="{{ user.username}} avatar">
        <RouterLink class=" text-xl bg-vert p-2 rounded-full h-10 w-10 pb-2.5 text-center margin_negative absolute" :to="'/editprofil/' + users.id"><i class="fa-solid fa-camera"></i></RouterLink>
    </div>
    <div class="flex flex-row p-7 justify-around w-full">
        <div class="flex flex-col p-7">
          <h3 class="text-xl font-bold">Pseudo</h3>
          <p>{{ users.username }}</p>
        </div>
        <div class="flex flex-col p-7">
          <h3 class="text-xl font-bold">Email</h3>
          <p>{{ users.email }}</p>
        </div>
    </div>
</template>

<style scoped>
</style>