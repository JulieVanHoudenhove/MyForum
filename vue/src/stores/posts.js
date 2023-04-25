import { defineStore } from 'pinia'
// Import axios to make HTTP requests
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
            try {
              const data = await axios.get('http://localhost:8000/api/posts?page=1')
                this.posts = data?.data?.['hydra:member'] || [];
            }
            catch (error) {
                alert(error)
                console.log(error)
            }
        }
    },
})