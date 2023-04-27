import { defineStore } from 'pinia'
import axios from "axios"

export const useLogStore = defineStore("log",{
    state: () => ({
        logs: [],
        isLoading: false,
    }),
    getters: {
        getLogs_check(state){
            return state.logs
        },
    },
    actions: {
        async checkCredentials(connexionParams) {
            this.isLoading = true;
            return new Promise(async (resolve, reject) => {
                return await axios.post(`http://localhost:8000/api/login_check`, connexionParams)
                    .then((response) => {
                        localStorage.setItem('token', response.data.token);
                        window.location.href = '/';
                    })
                    .catch((error) => {
                        if (error.request.status === 401) {
                            document.getElementById('error').innerHTML = 'Identifiants incorrects';
                        }
                    })
                    .finally(() => {
                        this.isLoading = false;
                    })
            });
        },
        async Register(inscriptionParams) {
            this.isLoading = true;
            return new Promise(async (resolve, reject) => {
                return await axios.post(`http://localhost:8000/api/register/`, inscriptionParams)
                    .then((response) => {
                        //  if(response.status == 201) {
                        //     this.checkCredentials;
                        //  }
                        console.log(response)
                        response.status == 201 ? window.location.href = "/connexion" : null ;
                        resolve(response);
                    })
                    .catch((error) => {
                        console.log('an error occured', error)
                    })
                    .finally(() => {
                        this.isLoading = false;
                    })
            });
        },
    }
})