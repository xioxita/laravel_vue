<script setup>
import Layout from "@/Layouts/Layout.vue";
import { Link } from '@inertiajs/vue3';

defineProps({
  stats: Object,
  top_books: Array,
  latest_reviews: Array
});
</script>

<template>
  <Layout>

    <div class="fixed inset-0 -z-10">
      <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
           class="w-full h-full object-cover opacity-60 blur-[2px]" alt="Fondo">
      <div class="absolute inset-0 bg-orange-50/60"></div>
    </div>

    <div class="container mx-auto p-6 min-h-screen relative">

      <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4 bg-white/70 backdrop-blur-md p-4 rounded-2xl border border-rose-200 shadow-sm">
        <h1 class="text-3xl font-bold text-rose-500">Panel de Administración</h1>
        <Link :href="route('main')" class="btn btn-outline btn-sm text-rose-500 hover:bg-rose-500 hover:text-white border-rose-300">
          Volver a la Web
        </Link>
      </div>

      <div class="stats stats-vertical lg:stats-horizontal shadow-xl w-full bg-white text-gray-700 mb-10 border border-rose-100">

        <div class="stat hover:bg-rose-50 transition-colors">
          <div class="stat-figure text-rose-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
          </div>
          <div class="stat-title text-gray-500">Usuarios Totales</div>
          <div class="stat-value text-rose-500">{{ stats.total_users }}</div>
          <div class="stat-desc text-gray-400">Registrados en la plataforma</div>
        </div>

        <div class="stat hover:bg-orange-50 transition-colors">
          <div class="stat-figure text-orange-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
          </div>
          <div class="stat-title text-gray-500">Libros</div>
          <div class="stat-value text-orange-400">{{ stats.total_books }}</div>
          <div class="stat-desc text-gray-400">En la biblioteca</div>
        </div>

        <div class="stat hover:bg-rose-50 transition-colors">
          <div class="stat-figure text-rose-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
          </div>
          <div class="stat-title text-gray-500">Reseñas</div>
          <div class="stat-value text-rose-600">{{ stats.total_reviews }}</div>
          <div class="stat-desc text-gray-400">Media global: ★ {{ stats.avg_rating }}</div>
        </div>

      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <div class="bg-white rounded-xl p-6 shadow-xl border border-rose-100">
          <h2 class="text-xl font-bold text-rose-500 mb-4 border-b border-rose-100 pb-2">🏆 Top 5 Libros</h2>
          <div class="overflow-x-auto">
            <table class="table text-gray-600">
              <thead>
              <tr class="text-gray-400 border-b border-rose-200">
                <th>Portada</th>
                <th>Título</th>
                <th>Rating</th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="book in top_books" :key="book.id" class="hover:bg-rose-50 border-b border-rose-50">
                <td>
                  <div class="avatar">
                    <div class="mask mask-squircle w-12 h-12 shadow-sm">
                      <img :src="book.cover_image" />
                    </div>
                  </div>
                </td>
                <td class="font-bold text-gray-700">{{ book.title }}</td>
                <td class="text-orange-400 font-bold">★ {{ book.rating }}</td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-xl border border-rose-100">
          <h2 class="text-xl font-bold text-rose-500 mb-4 border-b border-rose-100 pb-2">💬 Actividad Reciente</h2>
          <div class="flex flex-col gap-4">
            <div v-for="review in latest_reviews" :key="review.id" class="flex gap-4 items-start bg-rose-50 p-4 rounded-lg border border-rose-100">
              <div class="avatar placeholder">
                <div class="bg-rose-300 text-white rounded-full w-10 shadow-sm">
                  <span class="text-xs">{{ review.user.name.substring(0,2).toUpperCase() }}</span>
                </div>
              </div>
              <div>
                <p class="text-sm font-bold text-gray-700">
                  {{ review.user.name }}
                  <span class="text-gray-500 font-normal">en {{ review.book.title }}</span>
                </p>
                <p class="text-xs text-gray-500 italic">"{{ review.comment.substring(0, 50) }}..."</p>
                <div class="text-orange-400 text-xs mt-1">
                  <span v-for="n in review.rating">★</span>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </Layout>
</template>