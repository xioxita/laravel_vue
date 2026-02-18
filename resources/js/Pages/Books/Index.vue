<script setup>
import Layout from "@/Layouts/Layout.vue";
import { Link, usePage } from '@inertiajs/vue3';
import { ref, computed, watch } from 'vue';
import ReviewModal from "@/Components/ReviewModal.vue";

const props = defineProps({
  books: Array,
  currentGenre: String
});

const page = usePage();
const user = computed(() => page.props.auth.user);
const showReviewModal = ref(false);
const selectedBook = ref(null);

watch(() => props.books, (newBooks) => {
  if (selectedBook.value) {
    const updatedBook = newBooks.find(b => b.id === selectedBook.value.id);
    if (updatedBook) selectedBook.value = updatedBook;
  }
}, { deep: true });

const openReviews = (book) => {
  selectedBook.value = book;
  showReviewModal.value = true;
};
</script>

<template>
  <Layout>
    <div class="container mx-auto p-6 min-h-screen">

      <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4 bg-white/60 backdrop-blur-md p-4 rounded-2xl shadow-sm border border-rose-100">
        <div class="flex items-center gap-4">
          <Link :href="route('main')" class="btn btn-circle btn-ghost text-rose-500 hover:bg-rose-100">❮</Link>
          <h2 class="text-3xl font-bold text-gray-800 capitalize">{{ currentGenre }}</h2>
          <span class="badge bg-rose-400 text-white border-none badge-lg">{{ books.length }} Libros</span>
        </div>
      </div>

      <div v-if="books.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-8 items-stretch">

        <div v-for="book in books" :key="book.id" class="card bg-white shadow-xl hover:shadow-2xl hover:shadow-rose-100 hover:scale-105 transition-all duration-300 border border-rose-50 flex flex-col">
          <figure class="px-4 pt-4">
            <div class="relative w-full aspect-[2/3] overflow-hidden rounded-xl">
              <img :src="book.cover_image" class="w-full h-full object-cover" />
            </div>
          </figure>

          <div class="card-body p-5 items-center text-center flex-grow">
            <h3 class="card-title text-lg font-bold text-gray-800 leading-tight mb-1">{{ book.title }}</h3>
            <p class="text-sm text-gray-500 font-medium mb-4">{{ book.author }}</p>

            <div class="card-actions mt-auto w-full">
              <button @click="openReviews(book)" class="btn bg-rose-400 hover:bg-rose-500 text-white border-none btn-sm w-full font-bold shadow-md shadow-rose-200">
                {{ user ? 'Valorar / Reseñas' : 'Ver Reseñas' }}
              </button>
            </div>
          </div>
        </div>
      </div>

    </div>

    <ReviewModal
        :show="showReviewModal"
        :book="selectedBook"
        :user="user"
        @close="showReviewModal = false"
    />

  </Layout>
</template>