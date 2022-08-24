<template>
<div class="container mt-5">
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Paire de devises</th>
            <th scope="col">Taux de conversion</th>
            </tr>
        </thead>
        <tbody>
            <tr class="table-secondary">
            <th scope="row">1</th>
            <td>Première devise -> Seconde devise</td>
            <td>5</td>
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
        },
        mounted(){
            // console.log('currency pairs mounted')
        }
    }
</script>