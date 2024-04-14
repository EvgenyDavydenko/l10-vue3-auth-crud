<template>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-4">
            <form>
                <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
                <div class="form-floating">
                    <input v-model="form.email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                    <input v-model="form.password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <button @click.prevent="login" class="btn btn-primary w-100 py-2 mt-4" type="submit">Sign in</button>
            </form>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';
export default {
    data(){
        return{
            form:{
                email: '',
                password:'',
            },
            errors:[]
        }
    },
    methods:{
        login(){
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/login', this.form).then(r =>{
                    localStorage.setItem('token', r.data.access_token);
                    this.$router.push({name: 'home'});
                    console.log(r.data.access_token);
                }).catch((error) =>{
                    this.errors = error.response.data.errors;
                })
            })
        }
    }
}
</script>

