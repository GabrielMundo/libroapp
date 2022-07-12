require('./bootstrap');
import { createApp } from 'vue';
// window.Vue = vue;

import App from './components/App.vue';

import VueAxios from 'vue-axios';
import axios from 'axios';

import { createWebHistory, createRouter } from 'vue-router';
import { routes } from './routes';

const router = createRouter({
	history: createWebHistory(),
	routes,
});

const app = createApp(App);
app.use(router);
app.use(VueAxios, axios)
app.mount('#app');