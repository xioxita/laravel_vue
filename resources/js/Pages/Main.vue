<script setup>
import Layout from "@/Layouts/Layout.vue";
import { usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import Login from '@/Pages/Auth/Login.vue';
import Modal from '@/Components/Modal.vue';
import Card from "@/Components/Card.vue";

const user = computed(() => usePage().props.auth.user);
const props = defineProps({ cards: Object });

const showLogin = ref(false);
</script>

<template>
  <Layout @open-modal='showLogin=true'>

    <div class="fixed inset-0 -z-10">
      <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
           class="w-full h-full object-cover opacity-90" alt="Fondo">
      <div class="absolute inset-0 bg-orange-50/40 mix-blend-multiply"></div>
    </div>

    <div v-if="user" class="py-12 relative">
      <h2 class="mb-8 px-6 text-4xl font-bold text-gray-800 text-center p-4 rounded-xl inline-block mx-auto">
        Explora la Biblioteca
      </h2>
      <div class="grid gap-8 px-6 sm:grid-cols-2 lg:grid-cols-4 container mx-auto">
        <Card
            v-for="card in props.cards"
            :key="card.title"
            :title="card.title"
            :description="card.description"
            :action="card.action"
            :img="card.img"
        />
      </div>
    </div>

    <div v-else class="min-h-[80vh] flex items-center justify-center relative">
      <div class="text-center max-w-2xl px-8 py-12 bg-white/70 backdrop-blur-md rounded-3xl shadow-2xl border border-rose-100">
        <h1 class="mb-5 text-6xl font-bold text-gray-800">BookReview</h1>
        <p class="mb-8 text-xl text-gray-600">
          La plataforma definitiva para gestionar tus lecturas.
          Descubre, valora y comparte.
        </p>
        <button @click="showLogin = true" class="btn bg-rose-400 hover:bg-rose-500 text-white border-none font-bold px-10 text-lg rounded-full shadow-lg">
          Iniciar Sesión
        </button>
      </div>
    </div>

    <Modal :show="showLogin" @close="showLogin=false">
      <Login @close="showLogin=false"/>
    </Modal>

  </Layout>
</template>