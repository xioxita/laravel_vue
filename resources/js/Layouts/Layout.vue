<script setup>

import Header from "@/Layouts/Header.vue";
import Nav  from "@/Layouts/Nav.vue";
import Footer from "@/Layouts/Footer.vue";

const emit = defineEmits(['open-modal']);

</script>

<template>
  <Header @open-modal="emit('open-modal')"/>
  <Nav/>
  <Main class="h-main bg- main">
    <slot></slot>
  </Main>
  <Footer/>
</template>

<style scoped>

</style>