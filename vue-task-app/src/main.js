// main.js
import { createApp } from 'vue';
import App from './App.vue';
import axios from 'axios';
import router from './router'; // Ruta al archivo router.js

const app = createApp(App).use(router);

// Configuración global de Axios
axios.defaults.baseURL = 'http://localhost:8000/api';

app.config.globalProperties.$axios = axios;

app.mount('#app');
