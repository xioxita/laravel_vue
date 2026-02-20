<script setup>
import Layout from "@/Layouts/Layout.vue";
import { usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import Login from '@/Pages/Auth/Login.vue';
import Register from '@/Pages/Auth/Register.vue';
import Modal from '@/Components/Modal.vue';
import Card from "@/Components/Card.vue";

const user = computed(() => usePage().props.auth.user);
const props = defineProps({ cards: Object });

const showLogin = ref(false);
const showRegister = ref(false);
</script>

<template>
  <Layout @open-login="showLogin = true" @open-register="showRegister = true">

    <div v-if="user" class="py-12 relative z-10">
      <h3 class="mb-4 px-6 text-4xl font-bold text-gray-800 text-center rounded-xl inline-block mx-auto w-full">
        Explora la Biblioteca
      </h3>
      <p class="mb-8 px-6 text-2xl font-bold text-gray-500 text-center rounded-xl inline-block mx-auto w-full">
        Elige una de las categorías para ver nuestros libros
      </p>

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

    <div v-else class="w-screen relative left-1/2 -translate-x-1/2 -my-8 flex items-center justify-center min-h-[calc(100vh-9rem)] overflow-hidden">

      <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
             class="w-full h-full object-cover opacity-90" alt="Fondo">
        <div class="absolute inset-0 bg-orange-50/40 mix-blend-multiply"></div>
      </div>

      <div class="relative z-10 text-center max-w-2xl px-8 py-12 bg-white/80 backdrop-blur-md rounded-3xl shadow-2xl border border-rose-100 mx-4">
        <h1 class="mb-5 text-5xl md:text-6xl font-bold text-gray-800">BookReview</h1>
        <p class="mb-8 text-lg md:text-xl text-gray-600">
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

    <Modal :show="showRegister" @close="showRegister=false">
      <Register @close="showRegister=false"/>
    </Modal>

  </Layout>
</template>