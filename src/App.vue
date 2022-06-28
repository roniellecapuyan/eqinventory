<script setup>
import { RouterLink, RouterView } from 'vue-router'
import AppHeader from './components/AppHeader.vue'
</script>

<template>
  <AppHeader />
  <div class="m-5">
    <RouterView/>

  </div>
</template>