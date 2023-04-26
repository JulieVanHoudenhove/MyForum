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
                        this.comments = res?.data?.['hydra:member'] || [] ;
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