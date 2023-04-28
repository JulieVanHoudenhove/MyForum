import api from "./api";
import { defineStore } from 'pinia'
import axios from "axios"

export const useCommentStore = defineStore("comment",{
    state: () => ({
        comments: [],
        isLoading: false,
    }),
    getters: {
        getCommentsByPostId: (state) => (postId) => {
            return state.comments?.filter(comment => comment.post.id === postId);
        },
        getCommentById: (state) => (id) => {
            return state.comments?.find(comment => comment.id === id);
        },
        getComments(state){
            return state.comments
        },
    },
    actions: {
        async fetchComments() {
            this.isLoading = true;
            return new Promise(async (resolve, reject) => {
                const headers = { 'Authorization': `Bearer ${localStorage.getItem('token')}` };
                return await api.get(`comments`, { headers})
                    .then((res) => {
                        this.comments = res?.data || [] ;
                        console.log('comments', this.comments);
                    })
                    .catch((err) => {
                        console.log('an error occured', err)
                    })
                    .finally(() => {
                        this.isLoading = false;
                    })
            });
        },
        async createComment(commentParams) {
            this.isLoading = true;
            return new Promise(async (resolve, reject) => {
                return await api.post(`comments`, commentParams)
                    .then(() => {
                        this.fetchComments();
                    })
                    .catch((err) => {
                        console.log('an error occured', err)
                    })
                    .finally(() => {
                        this.isLoading = false;
                    })
            });
        },
        async deleteComment(id) {
            this.isLoading = true;
            return new Promise(async (resolve, reject) => {
                return await axios.delete(`http://localhost:8000/api/comments/${id}`)
                    .then((response) => {
                        this.fetchComments();
                    })
                    .catch((err) => {
                        console.log('an error occured', err)
                    })
                    .finally(() => {
                        this.isLoading = false;
                    })
            });
        },
    }
})