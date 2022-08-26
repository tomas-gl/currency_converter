<template>
    <div class="container mt-5">
        <div class="row">
            <ul v-for="currencyPair in currencyPairs" :key="currencyPair.id">
                <li>{{ currencyPair.first_currency_name}} ({{ currencyPair.first_currency_iso_code }}) 
                    &#8660; 
                    {{ currencyPair.second_currency_name}} ({{ currencyPair.second_currency_iso_code }})
                    :
                    {{ currencyPair.conversion_request}}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'ApiCurrencyPairsSupported',
        data(){
            return {
                currencyPairs:[],
            }
        },        
        created(){
            this.getCurrencyPairs();
        },
        methods:{
            async getCurrencyPairs(){
                let url = 'http://127.0.0.1:8000/api/getCurrencyPairs'
                await axios.get(url).then(response =>{
                    this.currencyPairs = response.data;
                    console.log(this.currencyPairs);
                }).catch(error =>{
                    console.log(error);
                });
            },
        },
    }
</script>