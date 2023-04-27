<script setup>
    import { reactive, computed } from "vue";
    import { useUserStore } from "../stores/users.js";
    
    const current = defineProps({utilisateur: {type: Object}})

    const userStore = useUserStore();
    // const postIsLoading = computed(() => store.isLoading);
    const fields = reactive({
        file: null,
    })

    const handleInputChange = (e) => {
        fields.file = e.target.files[0];
    }
    
    const changeAvatar = () => {
        console.log(current);
        userStore.changeAvatar({fields, current});
    }
</script>

<template>
    <main  class=" mt-20 flex flex-col items-center justify-center font-Poppins">
        <h1 class="h1 text-vert">Changez votre photo de profil</h1>
        <form @submit.prevent="changeAvatar" class="flex flex-col items-center justify-center p-7">
            <div class="flex flex-col justify-center items-center m-12">
                <h3 class="text-xl font-bold pb-7">Votre photo actuelle :</h3>
                <img class="bg-white rounded-full h-32 w-32" src="user.avatar" alt="">
            </div>
            <div class="flex flex-col items-center justify-center p-7">
                <label class="mb-2" for="upload_img">Ajouter une photo</label>
                <input @change="handleInputChange" class="py-2.5 px-5 bg-gris_input text-gris_text border-gris_input rounded-lg" type="file" name="avatar" id="avatar">
            </div>
            <input class="m-5 py-2.5 px-5 bg-vert border-vert border-2 rounded-lg text-white transition duration-300 text-lg hover:bg-transparent hover:text-vert" type="submit" value="Mettre à jour">
        </form>
    </main>
</template>
  
<style>
</style>