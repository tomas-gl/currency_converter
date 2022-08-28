<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12 offset-md-3 col-md-6">
                <form @submit.prevent="updateCurrencyPairCount" novalidate class="p-3">
                    <div class="row">
                        <span class="fs-3 d-block mb-5 text-center">Convertir une devise</span>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="exampleFormControlSelect1">Première devise</label>
                                <select class="form-control" id="firstSelectedCurrency" @change="getSelectedCurrency($event)">
                                    <option v-for="currency in currencies" :key="currency.id" :value="currency.id">{{ currency.iso_code }}</option>
                                </select>
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label for="exampleFormControlSelect1">Seconde devise</label>
                                <select class="form-control" id="secondSelectedCurrency" @change="getSelectedCurrency($event)">
                                    <option v-for="currency in currencies" :key="currency.id" :value="currency.id">{{ currency.iso_code }}</option>
                                </select>
                        </div>

                        <div class="alert alert-danger" v-if="errors.length">
                            <ul class="mb-0">
                                <li v-for="(error, index) in errors" :key="index">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="row" v-if="!errors.length && firstSelection">
                        <div class="mb-3 col-12 col-md-5">
                            <label>{{ firstSelectedCurrency }}</label>
                            <input v-if="!revertedConversion" type="number" step=".01" min="0" class="form-control normal" id="firstConverion" 
                                    :value="firstConversion" @change="convertCurrency($event)">
                            <input v-if="revertedConversion" type="number" step=".01" min="0" class="form-control reverted" id="firstConverion" 
                                    :value="firstConversion" @change="convertCurrency($event)">
                        </div>
                        <div class="mb-3 col-12 col-md-2 text-center">
                            <span class="fs-1">&#8596;</span>
                        </div>
                        <div class="mb-3 col-12 col-md-5">
                            <label>{{ secondSelectedCurrency }}</label>
                            <input v-if="!revertedConversion" type="number" step=".01" min="0" class="form-control normal" id="secondConverion" 
                                    :value="secondConversion" @change="convertCurrency($event)">
                            <input v-if="revertedConversion" type="number" step=".01" min="0" class="form-control reverted" id="secondConverion" 
                                    :value="secondConversion" @change="convertCurrency($event)">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'ApiHome',
        data(){
            return {
                currencyPairs:[],
                currencies: [],
                selectedCurrencyPairs: [],
                selectedCurrencyPair: '',
                selectedCurrencyExiste: false,
                firstSelectedCurrency: '',
                secondSelectedCurrency: '',
                firstConversion: '',
                secondConversion: '',
                firstConversionRate: '',
                secondConversionRate: '',
                revertedConversion: false,
                firstSelection: false,
                errors: [],
            }
        },        
        created(){
            this.getCurrencyPairs();
            this.getCurrencies();
            this.updateCurrencyPairCount();
        },
        methods:{

            // Get selected currency info
            getSelectedCurrency(event){
                this.firstSelection = true;
                this.selectedCurrencyExiste = false;
                this.conversionRate = [];
                this.revertedConversion = false;
                this.firstConversion = '',
                this.secondConversion = '',
                this.errors = [];
                if(event.target.id == "firstSelectedCurrency"){
                    this.selectedCurrencyPairs[0] = event.target.options[event.target.selectedIndex].text;
                    this.firstSelectedCurrency = event.target.options[event.target.selectedIndex].text;
                    }
                else if(event.target.id == "secondSelectedCurrency"){
                     this.selectedCurrencyPairs[1] = event.target.options[event.target.selectedIndex].text;
                     this.secondSelectedCurrency = event.target.options[event.target.selectedIndex].text;
                }
                this.currencyPairs.forEach(el => {
                    if(
                        el.first_currency_iso_code == this.selectedCurrencyPairs[0] && el.second_currency_iso_code == this.selectedCurrencyPairs[1]
                        ||
                        el.second_currency_iso_code == this.selectedCurrencyPairs[0] && el.first_currency_iso_code == this.selectedCurrencyPairs[1]
                    ){
                        this.selectedCurrencyPair = el;
                        this.selectedCurrencyExiste = true;
                        this.selectedCurrencyPair.conversion_request++;
                        if(el.first_currency_iso_code == this.selectedCurrencyPairs[0] && el.second_currency_iso_code == this.selectedCurrencyPairs[1]){
                            this.firstConversionRate = el.conversion_rate;
                            this.secondConversionRate = parseFloat(1/el.conversion_rate).toFixed(2);
                            this.revertedConversion = false;
                        }
                        else if(el.second_currency_iso_code == this.selectedCurrencyPairs[0] && el.first_currency_iso_code == this.selectedCurrencyPairs[1]){
                            this.firstConversionRate = parseFloat(1/el.conversion_rate).toFixed(2);
                            this.secondConversionRate = el.conversion_rate;
                            this.revertedConversion = true;
                        }
                        return;
                    }
                });
                if(this.selectedCurrencyPairs[0] == this.selectedCurrencyPairs[1]){
                    this.errors.push("Veuillez sélectionner 2 devises différentes")
                }
                if(!this.selectedCurrencyExiste){
                    this.errors.push("Paire de devises non supportées");
                }
                this.updateCurrencyPairCount();
            },

            // Convert a currency
            convertCurrency(event){
                if(event.target.id == "firstConverion"){
                    this.firstConversion = event.target.value;
                    this.secondConversion = event.target.value * this.firstConversionRate;
                    this.secondConversion = parseFloat(this.secondConversion).toFixed(2);
                }
                else if(event.target.id == "secondConverion"){
                    this.secondConversion = event.target.value;
                    this.firstConversion = event.target.value * this.secondConversionRate;
                    this.firstConversion = parseFloat(this.firstConversion).toFixed(2);
                }
            },

            // Get currencies pair list
            async getCurrencyPairs(){
                let url = 'http://127.0.0.1:8000/api/getCurrencyPairs'
                await axios.get(url).then(response =>{
                    this.currencyPairs = response.data;
                    this.currencyPairs.forEach(element => {
                        element.convertedCurrency = parseFloat(1/element.conversion_rate).toFixed(2);
                    });
                }).catch(error =>{
                    console.log(error);
                });
            },

            // Get currencies list
            async getCurrencies(){
                let url = 'http://127.0.0.1:8000/api/getCurrencies'
                await axios.get(url).then(response =>{
                    this.currencies = response.data;
                    this.selectedCurrencyPairs = [this.currencies[0].iso_code, this.currencies[0].iso_code];
                    this.firstSelectedCurrency = this.currencies[0].iso_code;
                    this.secondSelectedCurrency = this.currencies[0].iso_code;
                }).catch(error =>{
                    console.log(error);
                });
            },

            // Update Currencies pair request count
            async updateCurrencyPairCount(){
                if(!this.errors.length && this.firstSelection){
                    let formData = new FormData();
                    formData.append('conversionRequest', this.selectedCurrencyPair.conversion_request);
                    let url = `http://127.0.0.1:8000/api/updateCurrencyPairCount/${this.selectedCurrencyPair.id}`;
                    await axios.post(url, formData).then((response) =>{
                        if(response.status == 200){
                            console.log(response.data.message);
                        }
                    }).catch(error =>{
                        this.errors.push(error.response);
                    });
                }
            }
        },
    }
</script>