import { defineStore } from 'pinia'
// Import axios to make HTTP requests
import axios from "axios"
import { useRoute } from 'vue-router'
const route = useRoute()
const id = route.params.id

export const usePostDetailStore = defineStore("post_detail",{
    state: () => ({
        posts_detail: [],
    }),
    getters: {
        getPostsDetail(state){
            return state.posts_detail
        }
    },
    actions: {
        async fetchPostsDetail() {
            try {
              const data = await axios.get('http://localhost:8000/api/posts/'+id)
                this.posts_detail = data.data;
            }
            catch (error) {
                alert(error)
                console.log(error)
            }
        }
    },
})