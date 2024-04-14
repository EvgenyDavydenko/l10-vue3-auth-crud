import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

import axios from 'axios';
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

// Import components
import App from './components/App.vue';
import Home from './components/Home.vue';
import About from './components/About.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component: Home, name: 'home' },
        { path: '/about', component: About, name: 'about' },
        { path: '/register', component: Register, name: 'register' },
        { path: '/login', component: Login, name: 'login' },
    ]
});

const app = createApp(App);
app.use(router);
app.mount('#app');