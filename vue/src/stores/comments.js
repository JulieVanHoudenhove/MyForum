import { defineStore } from 'pinia'
// Import axios to make HTTP requests
import axios from "axios"

export const useCommentStore = defineStore("comment",{
    state: () => ({
        comments: [],
    }),
    getters: {
        getComments(state){
            return state.comments
        }
    },
    actions: {
        async fetchComments() {
            try {
                const data = await axios.get('http://localhost:8000/api/comments?page=1&post=${id}')
                this.comments = data.data['hydra:member'];
            }
            catch (error) {
                alert(error)
                console.log(error)
            }
        }
    },
})