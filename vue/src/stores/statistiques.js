import { defineStore } from 'pinia'
import axios from "axios"

export const useLogStore = defineStore("statistique",{
    state: () => ({
        statistiques: [],
        isLoading: false,
    }),
    getters: {
        getStatistiques(state){
            return state.statistiques
        },
    },
    actions: {
        async fetchStats() {
            this.isLoading = true;
            return new Promise(async (resolve, reject) => {
                return await axios.get(`http://127.0.0.1:8000/api/user_stats/${id}`)
                    .then((response) => {
                        
                    })
                    .catch((error) => {
                        
                            reject(error);
                    })
                    .finally(() => {
                        this.isLoading = false;
                    })
            });
        },
    }
})