import {createApp} from 'vue'
import './style.css'
import App from './App.vue'
import {createPinia} from "pinia";
import router from "./router/index.js";
import currencyUSD from "./filters/currency.js";
import dateFormat from "./filters/dateFormat.js";
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';


const options = {
    confirmButtonColor: '#0A66C2',
    cancelButtonColor: '#EF4444',
};


const pinia = createPinia()

const app = createApp(App);
app.use(pinia)
    .use(router)
    .use(VueSweetalert2, options)
    .mount('#app');
window.Swal =  app.config.globalProperties.$swal;

app.config.globalProperties.$filters = {
    currencyUSD,
    dateFormat
}
