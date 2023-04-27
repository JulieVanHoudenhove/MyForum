<script setup>
    import { ref } from 'vue'
    defineProps({
        users: {
            type: Object,
            required: true
        },
    })
    const current = ref();

    const parseJwt = (token) => {
        var base64Url = token.split('.')[1];
        var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));

        return JSON.parse(jsonPayload);
    }

    if (localStorage.getItem('token')) {
        current.value = parseJwt(localStorage.getItem('token'));
        console.log(parseJwt(localStorage.getItem('token')))
    }
</script>

<template>
    <div class="flex flex-row-reverse items-end p-7 relative">
        <img class="bg-white rounded-full h-32 w-32" :src="'http://localhost:8000/uploads/avatars/' + users.avatar" :alt=" users.username + 'avatar'">
        <RouterLink v-if="current && current.id == users.id" class=" text-xl bg-vert p-2 rounded-full h-10 w-10 pb-2.5 text-center margin_negative absolute" :to="'/editprofil/' + users.id"><i class="fa-solid fa-camera"></i></RouterLink>
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