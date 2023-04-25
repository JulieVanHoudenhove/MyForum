import { defineStore } from 'pinia'
// Import axios to make HTTP requests
import axios from "axios"

export const useCommentStore = defineStore("comment",{
    state: () => ({
        comments: [],
        isLoading: false,
    }),
    getters: {
        getCommentByPostId: (state) => (postId) => {
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
                        console.log('comments', this.comments)
                    })
                    .catch((err) => {
                        console.log('an error occured', err)
                    })
                    .finally(() => {
                        this.isLoading = false;
                    })
            });
            // try {
            //     const data = await axios.get(`http://localhost:8000/api/comments?page=1&post=${id}`);
            //     this.comments = data?.data?.['hydra:member'] || [] ;
            // }
            // catch (error) {
            //     alert(error)
            //     console.log(error)
            // }
        }
    },
})