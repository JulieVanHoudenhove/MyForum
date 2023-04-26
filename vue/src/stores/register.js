import { defineStore } from 'pinia'
import axios from "axios"

export const useRegisterStore = defineStore("register",{
    state: () => ({
        registers: [],
        isLoading: false,
    }),
    getters: {
        getRegisters(state){
            return state.registers
        },
    },
    actions: {
        async postRegister() {
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