<template>
  <div>
    <Header />
    <router-view></router-view>
  </div>
</template>

<script>
  import Header from './components/Header.vue';


export default {
  name: 'App',
  data(){
    return{
      user: null
    }
  },
  mounted(){
  },
  components: {
    Header
  },
    methods: {
    }
}
</script>

<style>
</style>
