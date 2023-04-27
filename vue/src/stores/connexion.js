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
                        resolve(response.data)
                    })
                    .catch((error) => {
                            document.getElementById('error').innerHTML = 'Identifiants incorrects';
                            reject(error);
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
                    .then(({data}) => {
                        this.checkCredentials({
                            "username": data.username,
                            "password": inscriptionParams.password,
                        }).then((res) => {
                            resolve(res);
                        }).catch((err) => {
                            console.log('het some problems', err);
                        });
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