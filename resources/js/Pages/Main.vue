<script setup>
import Layout from "@/Layouts/Layout.vue";
import { usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import Login from "@/Pages/Auth/Login.vue";
import Modal from "@/Components/Modal.vue";
import Card from "@/Components/Card.vue"; // 1. IMPORTAR EL COMPONENTE

// 2. RECIBIR LOS DATOS DEL CONTROLADOR
defineProps({
  cards: Array
});

const page = usePage();
const user = computed(() => page.props.auth.user);
const showLogin = ref(false);

const closeModal = () => {
  showLogin.value = false;
};
</script>

<template>
  <Layout @open-modal="showLogin = true">

    <div v-if="user" class="container mx-auto p-6">
      <h2 class="text-2xl font-bold mb-6 text-white">Funcionalidades del Proyecto </h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
        <Card
            v-for="item in cards"
            :key="item.id"
            :title="item.title"
            :description="item.description"
            :img="item.img"
            :buttonText="item.buttonText"
        />
      </div>
    </div>

    <div v-else>
      <div class="hero min-h-screen" style="background-image: url(https://img.daisyui.com/images/stock/photo-1507358522600-9f71e620c44e.webp);">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-neutral-content text-center">
          <div class="max-w-md">
            <h1 class="mb-5 text-5xl font-bold">Bienvenido</h1>
            <p class="mb-5">Gestión integral del instituto.</p>
            <button @click="showLogin = true" class="btn btn-primary">Iniciar Sesión</button>
          </div>
        </div>
      </div>
    </div>

    <Modal :show="showLogin" @close="closeModal">
      <Login @close="closeModal" />
    </Modal>

  </Layout>
</template>