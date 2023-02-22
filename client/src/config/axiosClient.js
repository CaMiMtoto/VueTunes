import axios from "axios";
import {useAuth} from "../stores/auth.js";

const http = axios.create({
    baseURL: "http://localhost:8000/api",
    headers: {
        "Content-type": "application/json",
    },
});


http.interceptors.request.use(config => {
    const authStore = useAuth();
    config.headers.Authorization = `Bearer ${authStore.user.token}`
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
