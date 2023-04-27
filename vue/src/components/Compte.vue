<script setup>
    import { computed } from 'vue'
    import { useUserStore } from '../stores/users';

    const userStore = useUserStore();

    const current = computed(() => userStore.getCurrentUser);

    const userImagePath = computed(() => {
        if (current.value.avatar?.includes('http')) {
            return current.value.avatar
        }

        return (`http://localhost:8000/uploads/avatars/${current.value.avatar}`)
    })
</script>

<template>
    <template v-if="current">
    <div class="flex flex-row-reverse items-end p-7 relative">
        <img class="bg-white rounded-full h-32 w-32" :src="userImagePath" :alt=" current.username + 'avatar'">
        <RouterLink class=" text-xl bg-vert p-2 rounded-full h-10 w-10 pb-2.5 text-center margin_negative absolute" :to="'/editprofil/' + current.id"><i class="fa-solid fa-camera"></i></RouterLink>
    </div>
    <div class="flex flex-row p-7 justify-around w-full">
        <div class="flex flex-col p-7">
          <h3 class="text-xl font-bold">Pseudo</h3>
          <p>{{ current.username }}</p>
        </div>
        <div class="flex flex-col p-7">
          <h3 class="text-xl font-bold">Email</h3>
          <p>{{ current.email }}</p>
        </div>
    </div>
    </template>
</template>

<style scoped>
</style>