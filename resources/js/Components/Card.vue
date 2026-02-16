<script setup>
// Definimos las "props" (los parámetros que recibe la tarjeta)
defineProps({
  title: {
    type: String,
    required: true
  },
  description: {
    type: String,
    default: 'Sin descripción'
  },
  img: {
    type: String,
    required: true
  },
  buttonText: {
    type: String,
    default: 'Ver más' // Si no le pasas texto, pondrá "Ver más"
  }
});
</script>

<template>
  <div class="card bg-base-100 w-96 shadow-sm hover:shadow-lg transition-shadow duration-300">
    <figure class="px-10 pt-10">
      <img
          :src="img"
          :alt="title"
          class="rounded-xl h-48 w-full object-cover"
      />
    </figure>
    <div class="card-body items-center text-center">
      <h2 class="card-title">{{ title }}</h2>

      <p>{{ description }}</p>

      <div class="card-actions justify-end">
        <button class="btn btn-primary">{{ buttonText }}</button>
      </div>
    </div>
  </div>
</template>