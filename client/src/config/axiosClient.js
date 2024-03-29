import axios from "axios";
import {useAuth} from "../stores/auth.js";

const http = axios.create({
    baseURL: "http://zatec-music-app.test/api",
    headers: {
        "Content-type": "application/json",
    },
});


http.interceptors.request.use(config => {
    const authStore = useAuth();
    let token = authStore.user.token;
    config.headers.Authorization = `Bearer ${token}`
    return config;
});


/*
http.interceptors.response.use(response => {
    return response;
}, error => {
    if (error.response.status === 401) {
        authStore.commit('setToken', null)
        router.push({name: 'login'}).then(r => console.log(r));
    }
    throw error;
})*/

export default http;
