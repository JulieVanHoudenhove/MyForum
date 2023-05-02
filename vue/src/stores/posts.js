import { defineStore } from 'pinia'
import axios from "axios"
import api from "./api";

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
                return await api.get(`posts?page=1`)
                    .then((data) => {
                        console.log('data', data.data),
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
        async fetchPostsLike() {
            this.isLoading = true;
            const headers = { 'Authorization': `Bearer ${localStorage.getItem('token')}` };
            return new Promise(async (resolve, reject) => {
                return await api.get(`posts?page=1`, { headers })
                    .then((data) => {
                        console.log('data', data.data),
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
        async createPost({fields}) {
            this.isLoading = true;

            const formData = new FormData();

            Object.entries(fields).forEach(([key, value]) => {
                formData.append(key, value); 
            });

            return new Promise(async (resolve, reject) => {
                return await api.post(`posts`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then((response) => {
                        resolve(response.data);
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
                axios.delete
                return await api.delete(`posts/${id}`)
                    .then((response) => {
                        resolve(response.data);
                    })
                    .catch((err) => {
                        console.log('an error occured', err)
                    })
                    .finally(() => {
                        this.isLoading = false;
                    })
            });
        },
        async likePost(likeParams) {
            this.isLoading = true;
            return new Promise(async (resolve, reject) => {
                return await api.post(`liked_posts`, likeParams)
                    .then((response) => {
                        store.fetchPosts();
                        console.log(response);
                        resolve(response.data);
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