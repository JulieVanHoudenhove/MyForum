import { defineStore } from 'pinia'
import axios from "axios"
import { parseJwt } from './token'
import {set} from 'lodash';

export const useUserStore = defineStore("user",{
    state: () => ({
        users: [],
        isLoading: false,
    }),
    getters: {
        getCurrentUser(state){
            const jwtUser = parseJwt(localStorage.getItem('token'));

            return state.users.find(user => user.id === jwtUser.id)
        },
        getUsers(state){
            return state.users
        },
    },
    actions: {
        async fetchUsers() {
            this.isLoading = true;
            return new Promise(async (resolve, reject) => {
                return await axios.get(`http://127.0.0.1:8000/api/users`)
                    .then((data) => {
                        console.log(data.data)
                        this.posts = data?.data || [] ;
                    })
                    .catch((err) => {
                        console.log('an error occured', err)
                    })
                    .finally(() => {
                        this.isLoading = false;
                    })
            });
        },
        async changePassword({fields, current}) {
            console.log(fields, current);
            this.isLoading = true;
            return new Promise(async (resolve, reject) => {
                return await axios.put(`http://localhost:8000/api/change-password/${current.utilisateur.id}`, fields)
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
        async changeAvatar({fields, current}) {
            console.log(fields, current);
            this.isLoading = true;

            const formData = new FormData();
            formData.append('file', fields.file);

            return new Promise(async (resolve, reject) => {
                return await axios.post('http://localhost:8000/api/change-avatar/'+current.utilisateur.id, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then((response) => {
                        const index = this.users.findIndex(user => user.id === current.utilisateur.id);

                        set(this.users, `${index}.avatar`, response.data.avatar);

                        resolve(response);

                        // if (response.status == 201) {
                        //     window.location.href = '/compte/'+current.utilisateur.id;
                        //   }
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