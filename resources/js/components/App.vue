<template>
    <div class="container">
        <header class="p-3 text-bg-dark">
            <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <router-link to="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                Домой
                </router-link>

                <ul class="nav col-12 col-lg-auto ms-lg-auto mb-2 justify-content-center mb-md-0">

                    <li><router-link to="/about" class="nav-link px-2 text-white">О нас</router-link></li>
                    <li><router-link to="/register" class="nav-link px-2 text-white">Регистрация</router-link></li>
                    <li><router-link to="/login" class="nav-link px-2 text-white">Войти</router-link></li>
                    <li><a @click.prevent="logout" class="nav-link px-2 text-white">Выйти</a></li>

                </ul>


            </div>
            </div>
        </header>

        <main class="py-5">
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: 'App',
        methods: {
            logout() {
                const token = localStorage.getItem('token');
                if (token) {
                    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
                }
                axios.get('/api/logout').then(res => {
                    localStorage.removeItem('token');
                    this.$router.push({name: 'login'});
                })
            }
        }
    }
</script>