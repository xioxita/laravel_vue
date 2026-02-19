<script setup>
import { computed } from 'vue';
import { Link, usePage } from "@inertiajs/vue3";

const page = usePage();
const user = computed(() => page.props.auth.user);

// Declaramos las dos señales diferentes
const emit = defineEmits(['open-login', 'open-register']);
</script>

<template>
  <header class="navbar bg-rose-100 border-b border-rose-200 px-4 sm:px-8 shadow-sm">
    <div class="flex-1 gap-4">
      <Link :href="route('main')" class="btn btn-ghost normal-case text-xl sm:text-2xl font-bold text-rose-600 tracking-wide hover:bg-rose-200">
        BookReview
      </Link>
    </div>

    <div class="flex-none gap-4">
      <div v-if="user" class="flex items-center gap-4">
        <span class="text-sm font-semibold text-gray-600 hidden sm:inline">
            Bienvenido <span class="text-rose-500 font-bold">{{ user.name }} :) </span>
        </span>
        <Link :href="route('logout')" method="post" as="button" class="btn btn-outline btn-error btn-sm rounded-full">
          Salir
        </Link>
      </div>

      <div v-else class="flex gap-2">
        <button @click="emit('open-login')" class="btn btn-sm bg-rose-400 hover:bg-rose-500 text-white border-none font-bold rounded-full shadow-lg">
          Acceso
        </button>
        <button @click="emit('open-register')" class="btn btn-ghost btn-sm hover:bg-rose-200 rounded-full text-rose-700">
          Registro
        </button>
      </div>
    </div>
  </header>
</template>