import { defineStore } from 'pinia'
import axios from "axios"

export const useLoginCheckStore = defineStore("login_check",{
    state: () => ({
        logins_check: [],
        isLoading: false,
    }),
    getters: {
        getLogins_check(state){
            return state.logins_check
        },
    },
    actions: {
        async checkCredentials() {
            this.isLoading = true;
            return new Promise(async (resolve, reject) => {
                return await axios.post(`http://localhost:8000/api/http://localhost:8000/api/login_check`), {
                    "username": document.getElementById('inputUsername').value,
                    "password": document.getElementById('inputPassword').value
                }
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
    }
})