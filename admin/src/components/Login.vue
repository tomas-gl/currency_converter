<template>
<div class="container">
    <div class="row mt-5">
        <div class="col-12 offset-md-3 col-md-6">
            <h1 class="fs-2 text-center mb-5">Currency Converter API</h1>
            <div class="row p-3 border rounded">
                <div class="mb-3 col-12">
                    <label class="form-label">Adresse email</label>
                    <input type="email" class="form-control" v-model="email">
                </div>
                <div class="mb-3 col-12">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" v-model="password">
                </div>

                <div class="alert alert-danger" v-if="errors.length">
                    <ul class="mb-0">
                        <li v-for="(error, index) in errors" :key="index">
                            {{ error }}
                        </li>
                    </ul>
                </div>

                <button @click="login" class="btn btn-primary w-auto mx-auto">S'authentifier</button>
            </div>
        </div>
    </div>
   
</div>
</template>

<script>
    import axios from 'axios';

    export default{
        name:"Login",
        data(){
            return {
                email: '',
                password: '',
                errors: [],
            }
        },
        created(){
        },
        methods:{
            
            // Login a user
            async login(){
                this.errors = [];
                if(!this.email.length){
                    this.errors.push("Veuillez entrer un email");
                }
                if(!this.password.length){
                    this.errors.push("Veuillez entrer un mot de passe");
                }
                if(!this.errors.length){
                    let formData = new FormData();
                    formData.append('email', this.email);
                    formData.append('password', this.password);
                    let url = 'http://127.0.0.1:8000/api/login';
                    await axios.post(url, formData).then(() =>{
                        this.$router.push('admin')
                    }).catch(error =>{
                        this.errors.push(error.response.data.message);
                    });
                }
            }
        },
        computed: {
        }
    }
</script>

<style>
</style>