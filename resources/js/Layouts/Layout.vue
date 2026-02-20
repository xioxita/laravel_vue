<script setup>
import Header from "@/Layouts/Header.vue";
import Nav from "@/Layouts/Nav.vue";
import Footer from "@/Layouts/Footer.vue";


const emit = defineEmits(['open-login', 'open-register']);
</script>

<template>
  <div class="min-h-screen flex flex-col bg-orange-50 text-gray-700" data-theme="cupcake">

    <Header
        @open-login="emit('open-login')"
        @open-register="emit('open-register')"
    />

    <Nav/>

    <main class="flex-grow container mx-auto px-4 py-8">
      <slot></slot>
    </main>

    <Footer/>
  </div>
</template>