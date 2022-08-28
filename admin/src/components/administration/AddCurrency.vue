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
    <div class="toast fade show position-fixed bottom-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true" v-if="currencyAdded">
        <div class="toast-header">
            <strong class="me-auto">Message de confirmation</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Devise ajoutée !
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
                currencyAdded: false,
                errors: [],
            }
        },        
        created(){
            this.getCurrencies();
        },
        methods:{
            async getCurrencies(){
                let url = 'http://127.0.0.1:8000/api/getCurrencies'
                await axios.get(url).then(response =>{
                    this.currencies = response.data;
                }).catch(error =>{
                    console.log(error);
                });
            },
            onlyLettersAndSpaces(str) {
                return /[^a-zA-Z]/.test(str);
            },
            async saveCurrency(){
                this.errors = [];
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
                    this.currencyAdded = false;
                    let formData = new FormData();
                    formData.append('currencyName', this.currencyName);
                    formData.append('isoCode', this.isoCode.toUpperCase());
                    let url = 'http://127.0.0.1:8000/api/saveCurrency';
                    await axios.post(url, formData).then((response) =>{
                        if(response.status == 200){
                            console.log(response.data.message);
                        }
                    this.currencyAdded = true;
                    this.currencyName = '';
                    this.isoCode = '';
                    });
                    this.getCurrencies();
                }
            }
        }
    }
</script>