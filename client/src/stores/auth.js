import http from "../config/axiosClient.js";
import {defineStore} from "pinia";
import router from "../router/index.js";

export const useAuth = defineStore('auth', {
    state: () => {
        return {
            user: {
                token: localStorage.getItem('TOKEN'),
                data: JSON.parse(localStorage.getItem('USER')),
            },
        }
    },
    actions: {
        login(data) {
            return http.post('/login', data)
                .then(({data}) => {
                    localStorage.setItem('TOKEN', data.token);
                    localStorage.setItem('USER', JSON.stringify(data.user));
                    return data;
                });
        },
        register(data) {
            return http.post('/register', data)
                .then(({data}) => {
                    localStorage.setItem('TOKEN', data.token);
                    localStorage.setItem('USER', JSON.stringify(data.user));
                });
        },
        logout() {
            this.user.token = null;
            localStorage.removeItem('TOKEN');
            localStorage.removeItem('USER');
            router.push({name: 'login'}).then(r => console.log(r));
        },
        getCurrentUser() {
            return http.get('/user')
                .then(({data}) => {
                    this.user.data = data;
                });
        }
    }
});
