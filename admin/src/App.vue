<template>
  <div>
    <Header :title="{ currentRouteName }" />
    <router-view></router-view>
  </div>
</template>

<script>
import Header from './components/Header.vue'

export default {
  name: 'App',
  components: {
    Header
  },
      computed: {
        currentRouteName() {
            return this.$route.name;
        },
    }
}
</script>

<style>
</style>
