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
        name: 'CurrencyPairsList'
    }
</script>