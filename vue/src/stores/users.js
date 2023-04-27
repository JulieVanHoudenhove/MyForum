import { defineStore } from 'pinia'
import axios from "axios"

export const useUserStore = defineStore("user",{
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
        async changePassword(changePasswordParams) {
            this.isLoading = true;
            return new Promise(async (resolve, reject) => {
                return await axios.put('http://localhost:8000/api/change-password/'+current.utilisateur.id, changePasswordParams)
                    .then((response) => {
                        console.log(response);
                    })
                    .catch((error) => {
                        console.log('an error occured', error)
                    })
                    .finally(() => {
                        this.isLoading = false;
                    })
            });
        },
        async changeAvatar(changeAvatarParams) {
            this.isLoading = true;
            return new Promise(async (resolve, reject) => {
                return await axios.postForm('http://localhost:8000/api/change-avatar/'+current.utilisateur.id, changeAvatarParams)
                    .then((response) => {
                        if (response.status == 201) {
                            window.location.href = '/compte/'+current.utilisateur.id;
                          }
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