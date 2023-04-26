import { defineStore } from 'pinia'
import axios from "axios"

export const useRegisterStore = defineStore("user",{
    state: () => ({
        users: [],
        isLoading: false,
    }),
    getters: {
        getUsers(state){
            return state.users
        },
    },
    actions: {
        async Register() {
            this.isLoading = true;
            return new Promise(async (resolve, reject) => {
                return await axios.post(`http://localhost:8000/api/register/`), {
                    'username': document.getElementById('pseudo').value,
                    'password': document.getElementById('mdp').value,
                    'email': document.getElementById('email').value,
                }
                    .then((response) => {
                        response.status == 201 ? checkCredentials : null;
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