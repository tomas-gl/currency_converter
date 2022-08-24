<template>
<div class="container mt-5">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Paire de devises</th>
                <th scope="col">Taux de conversion (sur base 1)</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody v-for="currency_pair in currency_pairs" :key="currency_pair.id">
            <tr class="table-secondary">
                <th scope="row">{{ currency_pair.id }}</th>
                <td>
                    {{ currency_pair.first_currency_iso_code }} -> {{ currency_pair.second_currency_iso_code }}
                    /
                    {{ currency_pair.second_currency_iso_code }} -> {{ currency_pair.first_currency_iso_code }}
                </td>
                <td>{{ currency_pair.conversion_rate }} / {{ 1/currency_pair.conversion_rate }}</td>
                <td><button type="button" class="btn btn-primary">Editer</button></td>
                <td><button type="button" class="btn btn-danger">Supprimer</button></td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'CurrencyPairsList',
        data(){
            return{
                currency_pairs:Array
            }
        },
        created(){
            this.getCurrencyPairs();
        },
        methods:{
            async getCurrencyPairs(){
                let url = 'http://127.0.0.1:8000/api/currency_pairs'
                await axios.get(url).then(response =>{
                    this.currency_pairs = response.data;
                    console.log(this.currency_pairs);
                }).catch(error =>{
                    console.log(error);
                });
            }
            //   formatNumber(num){
            //     return parseFloat(num).toFixed(2)
            // }
        },
        mounted(){
            // console.log('currency pairs mounted')
        }
    }
</script>