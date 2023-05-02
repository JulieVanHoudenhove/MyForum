import { defineStore } from 'pinia'
import axios from "axios"
import api from './api'

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
                return await api.get(`user_stats/${id}`)
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