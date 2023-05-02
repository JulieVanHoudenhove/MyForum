import { defineStore } from 'pinia'
import axios from "axios"
import api from './api'

axios.interceptors.request.use(function (response) {
    return response
}, function (error) {
    console.log('sup', error)
    return Promise.reject(error)
})

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
            // this.isLoading = true;
            // const { data } = await api.post(`login_check`, connexionParams)
            // console.log('data', data);

            return new Promise(async (resolve, reject) => {
                return await api.post(`login_check`, connexionParams)
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
                return await api.post(`register/`, inscriptionParams)
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
                        reject(error);
                    })
                    .finally(() => {
                        this.isLoading = false;
                    })
            });
        },
    }
})