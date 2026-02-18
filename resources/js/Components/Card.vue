<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  title: { type: String, required: true },
  description: { type: String, default: '' },
  img: { type: String, required: true },
  action: { type: String, required: true },
});
</script>

<template>
  <div class="card bg-white/80 backdrop-blur-md border border-rose-200 shadow-xl hover:shadow-rose-300/50 hover:scale-105 transition-all duration-300 h-full flex flex-col overflow-hidden group">

    <figure class="relative h-48 overflow-hidden">
      <img
          :src="img"
          :alt="title"
          class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
      />
    </figure>

    <div class="card-body items-center text-center flex-grow p-5">
      <h2 class="card-title text-2xl font-bold text-gray-800">{{ title }}</h2>
      <p class="text-gray-600 text-sm line-clamp-2">{{ description }}</p>

      <div class="card-actions mt-auto w-full justify-center pt-4">
        <Link :href="action" class="btn bg-rose-400 hover:bg-rose-500 text-white border-none w-full shadow-md shadow-rose-200">
          Ver Libros
        </Link>
      </div>
    </div>
  </div>
</template>