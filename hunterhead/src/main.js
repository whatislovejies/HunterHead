import { createApp } from 'vue';
import './style.css';
import App from './App.vue';
import Axios from 'axios'
import createRouterInstance from './router'; // Измененный импорт
import store from './store';
const app = createApp(App);

const router = createRouterInstance(store); // Создание экземпляра маршрутизатора

app.use(router);
app.use(store);

app.mount('#app');
