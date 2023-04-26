import { defineStore } from 'pinia'
import axios from "axios"

export const usePostStore = defineStore("post",{
    state: () => ({
        posts: [],
    }),
    getters: {
        getPostById: (state) => (id) => {
            return state.posts?.find(post => post.id === id);
        },
        getPosts(state){
            return state.posts
        }
    },
    actions: {
        async fetchPosts() {
            this.isLoading = true;
            return new Promise(async (resolve, reject) => {
                return await axios.get(`http://localhost:8000/api/posts?page=1`)
                    .then((data) => {
                        this.posts = data?.data?.['hydra:member'] || [] ;
                    })
                    .catch((err) => {
                        console.log('an error occured', err)
                    })
                    .finally(() => {
                        this.isLoading = false;
                    })
            });
        }
    },
})