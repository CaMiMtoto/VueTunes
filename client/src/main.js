import {createApp} from 'vue'
import './style.css'
import App from './App.vue'
import {createPinia} from "pinia";
import router from "./router/index.js";
const pinia = createPinia()

createApp(App)
    .use(pinia)
    .use(router)
    .mount('#app')
