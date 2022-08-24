<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12 offset-md-3 col-md-6">
                <form @submit.prevent="saveCurrencyPair" novalidate class="row p-5 border rounded">

                    <div class="mb-3 col-12 col-md-6">
                        <label for="exampleFormControlSelect1">Première devise</label>
                            <select class="form-control" v-model="first_currency_id" @change="getFirstSelectedCurrency($event)">
                                <option v-for="currency in currencies" :key="currency.id" :value="currency.id">{{ currency.iso_code }}</option>
                            </select>
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="exampleFormControlSelect1">Seconde devise</label>
                            <select class="form-control" v-model="second_currency_id" @change="getSecondSelectedCurrency($event)">
                                <option v-for="currency in currencies" :key="currency.id" :value="currency.id">{{ currency.iso_code }}</option>
                            </select>
                    </div>

                    <div class="mb-3 col-12 col-md-5">
                        <label>{{ first_selected_currency }}</label>
                        <input disabled class="form-control" placeholder="Taux de conversion" value="1">
                    </div>
                    <div class="mb-3 col-12 col-md-2 text-center">
                        <span class="fs-1">-></span>
                    </div>
                    <div class="mb-3 col-12 col-md-5">
                        <label>{{ second_selected_currency }}</label>
                        <input type="number" step=".01" min="0" class="form-control" placeholder="Taux de conversion" 
                                v-model="conversion_rate" 
                                @change="convertCurrency($event)">
                    </div>

                    <div class="mb-3 col-12 col-md-5">
                        <label>{{ second_selected_currency }}</label>
                        <input disabled class="form-control" placeholder="Taux de conversion" value="1">
                    </div>
                    <div class="mb-3 col-12 col-md-2 text-center">
                        <span class="fs-1">-></span>
                    </div>
                    <div class="mb-3 col-12 col-md-5">
                        <label>{{ first_selected_currency }}</label>
                        <input disabled type="number" step=".01" min="0" class="form-control" placeholder="Taux de conversion" :value="convertedCurrency">
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
        name: 'AddCurrencyPair',
        data(){
            return {
                first_selected_currency: '',
                second_selected_currency: '',
                convertedCurrency: '',
                currencies:Array,
                currency_pair: {},
                first_currency_id: '',
                second_currency_id: '',
                conversion_rate: '',
                errors: [],
            }
        },        
        created(){
            this.getCurrencies();
        },
        methods:{
            getFirstSelectedCurrency(event){
                console.log(event.target.options[event.target.selectedIndex].text);
                this.first_selected_currency = event.target.options[event.target.selectedIndex].text;
            },
            getSecondSelectedCurrency(event){
                console.log(event.target.options[event.target.selectedIndex].text);
                this.second_selected_currency = event.target.options[event.target.selectedIndex].text;
            },
            convertCurrency(event){
                console.log(event.target.value);
                this.convertedCurrency = 1/event.target.value;
            },
            async getCurrencies(){
                let url = 'http://127.0.0.1:8000/api/currencies'
                await axios.get(url).then(response =>{
                    this.currencies = response.data;
                    console.log(this.currencies);
                }).catch(error =>{
                    console.log(error);
                });
            },
            async saveCurrencyPair(){
                this.errors = [];
                if(!this.first_currency_id || !this.second_currency_id){
                    this.errors.push("Veuillez sélectionner 2 devises")
                }
                if(this.first_currency_id == this.second_currency_id){
                    this.errors.push("Veuillez sélectionner 2 devises différentes")
                }
                if(this.conversion_rate == 0){
                    this.errors.push("Le taux de conversion doit être supérieur à 0")
                }

                if(!this.errors.length){
                    let formData = new FormData();
                    formData.append('first_currency_id', this.first_currency_id);
                    formData.append('second_currency_id', this.second_currency_id);
                    formData.append('conversion_rate', this.conversion_rate);
                    console.log(formData);
                    let url = 'http://127.0.0.1:8000/api/save_currency_pair';
                    await axios.post(url, formData).then((response) =>{
                        console.log(response);
                        if(response.status == 200){
                            alert(response.data.message);
                        }
                    });
                }
            }
        }
    }
</script>