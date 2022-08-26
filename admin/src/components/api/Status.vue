<template>
    <div class="container">
        <div class="row mt-5">
            <h1 v-if="serverStatus.length">{{ serverStatus }}</h1>
            <h1 v-else>Service coupé</h1>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'ApiStatus',
        data(){
            return {
                serverStatus: '',
            }
        },        
        created(){
            this.getServerStatus();
        },
        methods:{
            async getServerStatus(){
                let url = 'http://127.0.0.1:8000/api/getServerStatus'
                await axios.get(url).then(response =>{
                    this.serverStatus = response.data;
                }).catch(error =>{
                    console.log(error);
                });
            },
        },
    }
</script>