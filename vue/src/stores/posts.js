import { defineStore } from 'pinia'
import axios from "axios"

export const usePostStore = defineStore("post",{
    state: () => ({
        posts: [],
        isLoading: false,
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
        },
        async createPosts() {
            this.isLoading = true;
            return new Promise(async (resolve, reject) => {
                return await axios.post(`http://localhost:8000/api/posts`), {
                    'title': document.getElementById('titre').value,
                    'text': document.getElementById('content').value,
                    'user': current.utilisateur['@id']
                
                    .then((response) => {
                        if (response.status === 201) {
                            window.location.href = '/';
                        }
                    })
                    .catch((err) => {
                        console.log('an error occured', err)
                    })
                    .finally(() => {
                        this.isLoading = false;
                    })
                }
            });
        },
        async deletePosts(id) {
            this.isLoading = true;
            return new Promise(async (resolve, reject) => {
                return await axios.delete(`http://localhost:8000/api/posts/`+id)
                    .then((response) => {
                        if (response.status == 204) {
                            window.location.href = "/";
                          }
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