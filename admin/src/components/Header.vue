<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" v-if="currentRoute == 'admin'">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item mx-2">
                        <router-link class="nav-link rounded" to="/admin">Home
                            <span class="visually-hidden">(current)</span>
                        </router-link>
                    </li>
                    <li class="nav-item mx-2">
                        <router-link class="nav-link rounded" to="/admin/add_currency_pair">Ajouter une paire de devises</router-link>
                    </li>
                    <li class="nav-item mx-2">
                        <router-link class="nav-link rounded" to="/admin/add_currency">Ajouter une devise</router-link>
                    </li>
                </ul>
                <span class="nav-item mx-2">
                    <router-link class="nav-link rounded" to="/api">Vers l'API</router-link>
                </span>
            </div>
            <div class="collapse navbar-collapse" v-if="currentRoute == 'api'">
                <ul class="navbar-nav me-auto" v-if="currentRoute == 'api'">
                    <li class="nav-item mx-2">
                        <router-link class="nav-link rounded" to="/api">Home
                            <span class="visually-hidden">(current)</span>
                        </router-link>
                    </li>
                    <li class="nav-item mx-2">
                        <router-link class="nav-link rounded" to="/api">Paires de devises supportées</router-link>
                    </li>
                    <li class="nav-item mx-2">
                        <router-link class="nav-link rounded" to="/api">État du serveur</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
export default{
    name:"Header",
    props:{
        title: Object
    },
    created(){
    },
    methods:{
    },
    computed: {
        currentRoute() {
            if(this.$route.path.startsWith("/admin")){
                return "admin"
            }
            else if(this.$route.path.startsWith("/api")){
                return "api"
            }
                return ""
        },
    }
}
</script>

<style>

/* .active {
    color: red;
} */

.exact-active-link {
    background-color: #373ca1 !important;
    color: #ffffff;
    font-weight: bold;
}
</style>