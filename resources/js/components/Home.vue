<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Home Component</div>

                    <div class="card-body">
                        {{message}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';  
    export default {
        data(){
            return{
                message: ''
            }
        },
        mounted() {
            axios.get('/api/hello').then(r => {
                console.log(r.data);
                this.message = r.data
            }).catch(error => {
                console.log(error.response.data.errors);
            })
        }
    }
</script>