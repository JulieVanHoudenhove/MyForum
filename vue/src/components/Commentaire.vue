<script setup>
    import {ref} from 'vue';
    defineProps({
        comment: {
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
    <article v-if="comment" class=" mr-12 mb-12 ml-12">
        <p class="my-6"><span class="font-semibold">{{ comment.user.username }}</span><br>{{ comment.text }}</p>
        <div class=" flex flex-row justify-between">
            <p>{{ new Date(comment.createdAt).toLocaleDateString('fr-FR', {'year':'numeric', 'month':'long', 'day':'numeric', 'hour':'numeric', 'minute': 'numeric'}) }}</p>
            <div v-if="current" class="w-20 flex flex-row justify-between text-vert ">
                <div class="w-12 flex flex-row justify-around">
                    <!-- <RouterLink to="/dislike/:id"><i class="fa-solid fa-heart"></i></RouterLink> -->
                    <RouterLink to="/like/:id"><i class="fa-regular fa-heart"></i></RouterLink>
                    <p>{{ comment.likes}}</p>
                </div>
                <RouterLink v-if="current && comment.user.id == current.id" class="text-vert" to="/removecom/:id"><i class="fa-solid fa-trash"></i></RouterLink>
            </div>
            <div v-if="!current" class="w-12 flex flex-row justify-around text-vert mb-5">
                <RouterLink to="/connexion"><i class="fa-regular fa-heart"></i></RouterLink>
                <p>{{ comment.likes }}</p>
            </div>
        </div>
    </article>
</template>

<style scoped>
</style>