<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"conversionAdd"}' class="btn btn-primary">Créer></router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Conversion</h4>
                </div>
                <div class="card-body">
                    <div class="table-reponsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>currency_to_convert_id</th>
                                    <th>currency_converted_id</th>
                                    <th>pair_reference_number</th>
                                    <th>conversion_rate</th>
                                </tr>
                            </thead>
                            <tbody v-if="conversions.length >0">
                                <tr v-for="(conversion,key) in conversions" :key="key">
                                    <td>{{ conversion.id }}</td>
                                    <td>{{ conversion.currency_to_convert_id }}</td>
                                    <td>{{ conversion.currency_converted_id }}</td>
                                    <td>{{ conversion.pair_reference_number }}</td>
                                    <td>{{ conversion.conversion_rate }}</td>
                                    <router-link :to='{name:"conversionEdit", params:{id:conversion.id}}' class="btn btn-success">Editer</router-link>
                                    <button type="button" @click="deleteConversion(conversion.id)" class="btn btn-danger">Supprimer</button>
                                <tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                <td colspan="4" align="center">Aucune conversion trouvée</td>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
