<template>
<div class="container">
    <div class="row mt-5">
        <div class="col-12 offset-md-3 col-md-6">
            <form @submit.prevent="saveCurrency" novalidate class="row p-3 border rounded">
                <span class="fs-3 d-block mb-5 text-center">Ajouter une devise</span>
                <div class="mb-3 col-9">
                    <label class="form-label">Nom de devise</label>
                    <input type="text" class="form-control" v-model="currencyName">
                </div>
                <div class="mb-3 col-3">
                    <label class="form-label">Code ISO</label>
                    <input type="text" class="form-control" v-model="isoCode">
                </div>

                <div class="alert alert-danger" v-if="errors.length">
                    <ul class="mb-0">
                        <li v-for="(error, index) in errors" :key="index">
                            {{ error }}
                        </li>
                    </ul>
                </div>

                <button type="submit" class="btn btn-primary w-auto mx-auto">Créer</button>
            </form>
        </div>
    </div>
</div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'AddCurrency',
        data(){
            return {
                currencyName: '',
                isoCode: '',
                currencies: {},
                errors: [],
            }
        },        
        created(){
            this.getCurrencies();
        },
        methods:{
            async getCurrencies(){
                let url = 'http://127.0.0.1:8000/api/currencies'
                await axios.get(url).then(response =>{
                    this.currencies = response.data;
                    console.log(this.currencies);
                }).catch(error =>{
                    console.log(error);
                });
            },
            onlyLettersAndSpaces(str) {
                return /[^a-zA-Z]/.test(str);
            },
            async saveCurrency(){
                this.errors = [];
                console.log(this.currencyName, this.isoCode)

                this.currencies.forEach(el => {
                    if(el.iso_code == this.isoCode){
                        this.errors.push("Devise déjà existante");
                    }
                });
                if(this.currencyName.length < 3){
                    this.errors.push("Veuillez entrer un nom de devise d'au moins 3 caractères");
                }
                if(this.isoCode.length != 3){
                    this.errors.push("le code ISO doit comporter 3 caractères");
                }   
                if(this.onlyLettersAndSpaces(this.isoCode)){
                    this.errors.push("le code ISO ne doit comporter que des lettres");
                }

                if(!this.errors.length){
                    let formData = new FormData();
                    formData.append('currencyName', this.currencyName);
                    formData.append('isoCode', this.isoCode.toUpperCase());
                    console.log(formData);
                    let url = 'http://127.0.0.1:8000/api/saveCurrency';
                    await axios.post(url, formData).then((response) =>{
                        console.log(response);
                        if(response.status == 200){
                            alert(response.data.message);
                        }
                    this.currencyName = '';
                    this.isoCode = '';
                    });
                    this.getCurrencies();
                }
            }
        }
    }
</script>