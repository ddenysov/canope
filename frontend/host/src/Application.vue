<script setup>
import {defineAsyncComponent} from "vue";
import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'

const WidgetNavbar = defineAsyncComponent(() => import('navbar/WidgetNavbar'))
</script>

<template>
  <WidgetNavbar />
  ssssssssffffdfdfdfdsddsdfdfdfdffdfdfdf
  <RouterLink to="/sign_up" class="menu-item" active-class="active">111ddsdыыSign dsssssdsd</RouterLink>
  <RouterView />
</template>

<style scoped>

</style>
