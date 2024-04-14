<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-4">
            <form>
                <h1 class="h3 mb-3 fw-normal">Register an account</h1>
                <div class="form-floating">
                    <input v-model="form.name" type="text" class="form-control" id="floatingName" placeholder="name">
                    <label for="floatingName">Name</label>
                </div>
                <div class="form-floating">
                    <input v-model="form.email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                    <input v-model="form.password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="form-floating">
                    <input v-model="form.password_confirmation" type="password" class="form-control" id="floatingPasswordConf" placeholder="Password confirmation">
                    <label for="floatingPasswordConf">Password confirmation</label>
                </div>
                <button @click.prevent="register" class="btn btn-primary w-100 py-2 mt-4" type="submit">Sign up</button>
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
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            errors:[]
        }
    },
    methods:{
        register(){
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/register', this.form).then(r =>{
                    this.$router.push({name: 'login'});
                    console.log(r);
                }).catch((error) =>{
                    this.errors = error.response.data.errors;
                })
            })
        }
    }
}
</script>

