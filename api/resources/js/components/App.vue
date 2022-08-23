<template>
    <main>
        <nav class="navbar navebar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <router-link to="/" class="navbar-brand" href="#">Titre 2</router-link>
                <div class="collapse navbar-collapse">
                    <router-link exact-active-class="active" to="/" class="nav-item nav-link">Home</router-link>
                    <router-link exact-active-class="active" to="/conversions" class="nav-item nav-link">Conversions</router-link>
            </div>
        </nav>
    </main>
</template>

<script>
export default {
    
}
</script>