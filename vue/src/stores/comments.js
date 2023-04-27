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
                return await axios.get(`http://localhost:8000/api/comments`)
                    .then((res) => {
                        this.comments = res?.data || [] ;
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
                return await axios.post(`http://localhost:8000/api/comments`, commentParams)
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