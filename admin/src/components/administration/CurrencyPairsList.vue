<template>
<div class="container mt-5">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Paires de devises</th>
                <th scope="col">Taux de conversion (sur base 1)</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody v-for="currencyPair in currencyPairs" :key="currencyPair.id">
            <tr class="table-secondary">
                <th scope="row">{{ currencyPair.id }}</th>
                <td>
                    {{ currencyPair.first_currency_name}} ({{ currencyPair.first_currency_iso_code }}) 
                    &#8660; 
                    {{ currencyPair.second_currency_name}} ({{ currencyPair.second_currency_iso_code }})
                </td>
                <td>{{ currencyPair.conversion_rate }} / {{ currencyPair.convertedCurrency }}</td>
                <td><router-link :to="{ name:'AdminEditCurrencyPair', params: { id: currencyPair.id} }" type="button" class="btn btn-primary">Modifier</router-link></td>
                <td><button type="button" class="btn btn-danger" @click.prevent="deleteCurrencyPair(currencyPair.id)">Supprimer</button></td>
            </tr>
        </tbody>
    </table>

    <div class="toast fade show position-fixed bottom-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true" v-if="currencyPairDeleted">
        <div class="toast-header">
            <strong class="me-auto">Message de confirmation</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Paire de devises supprimée !
        </div>
    </div>
</div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'CurrencyPairsList',
        data(){
            return{
                currencyPairs:[],
                convertedCurrency: '',
                currencyPairDeleted: false,
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
                    this.currencyPairs.forEach(element => {
                        element.convertedCurrency = parseFloat(1/element.conversion_rate).toFixed(2);
                    });
                    console.log(this.currencyPairs);
                }).catch(error =>{
                    console.log(error);
                });
            },
            async deleteCurrencyPair(id){
                this.currencyPairDeleted = false;
                let url = `http://127.0.0.1:8000/api/deleteCurrencyPair/${id}`;
                await axios.delete(url).then(response =>{
                    if(response.data.code == 200){
                        console.log(response.data.message);
                        this.currencyPairDeleted = true;
                        this.getCurrencyPairs();
                    }
                }).catch(error =>{
                    console.log(error);
                });
            }
        },
        mounted(){
        }
    }
</script>