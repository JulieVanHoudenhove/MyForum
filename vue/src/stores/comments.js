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
                        this.comments = res?.data?.['hydra:member'] || [] ;
                    })
                    .catch((err) => {
                        console.log('an error occured', err)
                    })
                    .finally(() => {
                        this.isLoading = false;
                    })
            });
        },
        async createComments() {
            this.isLoading = true;
            return new Promise(async (resolve, reject) => {
                return await axios.post(`http://localhost:8000/api/comments`), {
                    'text': document.getElementById('text').value,
                    'post': "/api/posts/"+postId.value,
                     'user': current.utilisateur['@id']
                }
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
        async deleteComments(id) {
            this.isLoading = true;
            return new Promise(async (resolve, reject) => {
                return await axios.delete('http://localhost:8000/api/comments/'+id)
                    .then((response) => {
                        if (response.status == 204) {
                            router.push({
                            name: 'detailPost',
                            params: {
                                id: post.value.id
                            }
                            });
                        }
                        //this.state.comments = this.state.comments.filter(o => o.id !== id);
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