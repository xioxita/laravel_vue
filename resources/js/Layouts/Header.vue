<script setup>
import { computed } from 'vue';
import { Link, usePage } from "@inertiajs/vue3";
import {defineEmits} from 'vue';

const page = usePage();
const user = computed(() => page.props.auth.user);

const emit = defineEmits(['open-modal']);
</script>

<template>
  <header class="h-20 bg-gray-200 flex justify-between px-5 items-center">

    <img src="/img/logo.png" alt="logo" class="max-h-full p-2">

    <h1 class="text-4xl text-blue-900">"GESTION DEL INSTITUTO"</h1>

    <div v-if="user" class="flex items-center gap-4">
      <p class="text-black">hola {{ user.name }}</p>
      <Link href="logout" method="post" as="button" class="text-red-500 font-bold">
        Logout
      </Link>
    </div>

    <div v-else class="space-x-2">
      <button @click="emit('open-modal')" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
        Login
      </button>
      <Link href="register" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition" as="button">
        Register
      </Link>
    </div>
  </header>
</template>