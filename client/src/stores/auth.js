import http from "../config/axiosClient.js";
import {defineStore} from "pinia";

export const useAuth = defineStore('auth', {
    state: () => {
        return {
            user: {
                token: localStorage.getItem('TOKEN'),
                data: {}
            },
        }
    },
    actions: {
        login(data) {
            return http.post('/login', data)
                .then(({data}) => {
                    this.user.data = data.user;
                    localStorage.setItem('TOKEN', data.token);
                    return data;
                });
        },
        register(data) {
            return http.post('/register', data)
                .then(({data}) => {
                    this.user.data = data.user;
                    localStorage.setItem('TOKEN', data.token);
                });
        },
        logout() {
            this.user.token = null;
            localStorage.removeItem('TOKEN');
        },
        getCurrentUser() {
            return http.get('/user')
                .then(({data}) => {
                    this.user.data = data;
                });
        }
    }
});
