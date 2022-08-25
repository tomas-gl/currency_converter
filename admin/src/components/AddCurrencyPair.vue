<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12 offset-md-3 col-md-6">
                <form @submit.prevent="saveCurrencyPair" novalidate class="row p-5 border rounded">

                    <div class="mb-3 col-12 col-md-6">
                        <label for="exampleFormControlSelect1">Première devise</label>
                            <select class="form-control" v-model="firstCurrencyId" @change="getFirstSelectedCurrency($event)">
                                <option v-for="currency in currencies" :key="currency.id" :value="currency.id">{{ currency.iso_code }}</option>
                            </select>
                    </div>
                    <div class="mb-3 col-12 col-md-6">
                        <label for="exampleFormControlSelect1">Seconde devise</label>
                            <select class="form-control" v-model="secondCurrencyId" @change="getSecondSelectedCurrency($event)">
                                <option v-for="currency in currencies" :key="currency.id" :value="currency.id">{{ currency.iso_code }}</option>
                            </select>
                    </div>

                    <div class="mb-3 col-12 col-md-5">
                        <label>{{ firstSelectedCurrency }}</label>
                        <input disabled class="form-control" placeholder="Taux de conversion" value="1">
                    </div>
                    <div class="mb-3 col-12 col-md-2 text-center">
                        <span class="fs-1">-></span>
                    </div>
                    <div class="mb-3 col-12 col-md-5">
                        <label>{{ secondSelectedCurrency }}</label>
                        <input type="number" step=".01" min="0" class="form-control" placeholder="Taux de conversion" 
                                v-model="conversionRate" 
                                @change="convertCurrency($event)">
                    </div>

                    <div class="mb-3 col-12 col-md-5">
                        <label>{{ secondSelectedCurrency }}</label>
                        <input disabled class="form-control" placeholder="Taux de conversion" value="1">
                    </div>
                    <div class="mb-3 col-12 col-md-2 text-center">
                        <span class="fs-1">-></span>
                    </div>
                    <div class="mb-3 col-12 col-md-5">
                        <label>{{ firstSelectedCurrency }}</label>
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
                firstSelectedCurrency: '',
                secondSelectedCurrency: '',
                convertedCurrency: '',
                currencies:Array,
                currencyPairs: {},
                firstCurrencyId: '',
                secondCurrencyId: '',
                conversionRate: '',
                errors: [],
            }
        },        
        created(){
            this.getCurrencyPairs();
            this.getCurrencies();
        },
        methods:{
            getFirstSelectedCurrency(event){
                console.log(event.target.options[event.target.selectedIndex].text);
                this.firstSelectedCurrency = event.target.options[event.target.selectedIndex].text;
            },
            getSecondSelectedCurrency(event){
                console.log(event.target.options[event.target.selectedIndex].text);
                this.secondSelectedCurrency = event.target.options[event.target.selectedIndex].text;
            },
            convertCurrency(event){
                console.log(event.target.value);
                this.convertedCurrency = 1/event.target.value;
            },
            async getCurrencyPairs(){
                let url = 'http://127.0.0.1:8000/api/currencyPairs'
                await axios.get(url).then(response =>{
                    this.currencyPairs = response.data;
                    console.log(this.currencyPairs);
                }).catch(error =>{
                    console.log(error);
                });
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
                this.currencyPairs.forEach(element => {
                    if(element.first_currency_id == this.firstCurrencyId && element.second_currency_id == this.secondCurrencyId
                     ||
                     element.first_currency_id == this.secondCurrencyId && element.second_currency_id == this.firstCurrencyId){
                        this.errors.push("Paire de devises déjà existante")
                    }
                });
                if(!this.firstCurrencyId || !this.secondCurrencyId){
                    this.errors.push("Veuillez sélectionner 2 devises")
                }
                if(this.firstCurrencyId == this.secondCurrencyId){
                    this.errors.push("Veuillez sélectionner 2 devises différentes")
                }
                if(this.conversionRate == 0){
                    this.errors.push("Le taux de conversion doit être supérieur à 0")
                }

                if(!this.errors.length){
                    let formData = new FormData();
                    formData.append('firstCurrencyId', this.firstCurrencyId);
                    formData.append('secondCurrencyId', this.secondCurrencyId);
                    formData.append('conversionRate', this.conversionRate);
                    console.log(formData);
                    let url = 'http://127.0.0.1:8000/api/saveCurrencyPair';
                    await axios.post(url, formData).then((response) =>{
                        console.log(response);
                        if(response.status == 200){
                            alert(response.data.message);
                        }
                    });
                    this.getCurrencyPairs();
                }
            }
        }
    }
</script>