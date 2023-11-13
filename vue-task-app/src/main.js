// main.js
import { createApp } from 'vue';
import App from './App.vue';
import axios from 'axios';

const app = createApp(App);

// Configuración global de Axios
axios.defaults.baseURL = 'http://localhost:8000/api';

app.config.globalProperties.$axios = axios;

app.mount('#app');
