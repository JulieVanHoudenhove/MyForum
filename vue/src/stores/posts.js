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
                        this.posts = data?.data || [] ;
                    })
                    .catch((err) => {
                        console.log('an error occured', err)
                    })
                    .finally(() => {
                        this.isLoading = false;
                    })
            });
        },
        async createPost(postParams) {
            this.isLoading = true;
            return new Promise(async (resolve, reject) => {
                return await axios.postForm(`http://localhost:8000/api/posts`, postParams)
                    .then((response) => {
                        if (response.status === 201) {
                            window.location.href = '/';
                        }
                        // resolve(response.data);
                    })
                    .catch((err) => {
                        console.log('an error occured', err)
                    })
                    .finally(() => {
                        this.isLoading = false;
                    })
            });
        },
        async deletePost(id) {
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