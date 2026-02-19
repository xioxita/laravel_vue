<script setup>
import { useForm } from '@inertiajs/vue3';
import { computed, watch, ref } from 'vue'; // Añadimos ref

const props = defineProps({
  show: Boolean,
  book: Object,
  user: Object
});

const emit = defineEmits(['close']);

const form = useForm({
  book_id: null,
  comment: '',
  rating: 0
});

// Nuevo estado para controlar si mostramos la advertencia de borrado
const showConfirmDelete = ref(false);

const myExistingReview = computed(() => {
  if (!props.book || !props.user) return null;
  return props.book.reviews.find(r => r.user_id === props.user.id);
});

watch(() => props.book, (newBook) => {
  if (newBook) {
    form.book_id = newBook.id;
    showConfirmDelete.value = false; // Reseteamos la advertencia al cambiar de libro
    if (myExistingReview.value) {
      form.comment = myExistingReview.value.comment;
      form.rating = myExistingReview.value.rating;
    } else {
      form.comment = '';
      form.rating = 0;
    }
  }
});

const submitReview = () => {
  form.post(route('reviews.store'), { preserveScroll: true });
};

// Nueva función que ejecuta el borrado real
const executeDelete = () => {
  form.delete(route('reviews.destroy', myExistingReview.value.id), {
    preserveScroll: true,
    onSuccess: () => {
      showConfirmDelete.value = false; // Ocultamos la advertencia tras borrar
    }
  });
};
</script>

<template>
  <dialog class="modal backdrop-blur-sm" :class="{ 'modal-open': show }" v-if="book">
    <div class="modal-box w-11/12 max-w-4xl bg-white border border-rose-100 text-gray-800 shadow-2xl">

      <div class="flex justify-between items-start mb-6 border-b border-gray-100 pb-4">
        <div>
          <h3 class="font-bold text-2xl text-rose-500">{{ book.title }}</h3>
          <p class="text-gray-500">Promedio: <span class="text-yellow-400">★ {{ book.rating }}</span></p>
        </div>
        <button @click="emit('close')" class="btn btn-sm btn-circle btn-ghost text-gray-500">✕</button>
      </div>

      <div class="overflow-y-auto max-h-60 mb-8 bg-rose-50/50 rounded-lg p-2 border border-rose-100">
        <table class="table text-gray-600">
          <thead>
          <tr class="text-gray-500 border-b border-rose-200">
            <th>Usuario</th>
            <th>Comentario</th>
            <th>Valoración</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="review in book.reviews" :key="review.id" class="border-b border-rose-100">
            <td class="font-bold text-rose-400">{{ review.user.name }}</td>
            <td class="italic text-gray-600">"{{ review.comment }}"</td>
            <td class="text-yellow-400 flex gap-1">
              <span v-for="n in review.rating" :key="n">★</span>
            </td>
          </tr>
          <tr v-if="book.reviews.length === 0">
            <td colspan="3" class="text-center py-4 text-gray-400">Aún no hay reseñas. ¡Sé el primero!</td>
          </tr>
          </tbody>
        </table>
      </div>

      <div v-if="user">

        <div v-if="showConfirmDelete" class="bg-rose-50 p-6 rounded-xl border border-rose-200 text-center shadow-inner">
          <h4 class="text-xl font-bold text-rose-600 mb-2">¿Estás seguro?</h4>
          <p class="text-gray-600 mb-6">Esta acción no se puede deshacer. Tu reseña será eliminada permanentemente de este libro.</p>
          <div class="flex justify-center gap-4">
            <button @click="showConfirmDelete = false" type="button" class="btn btn-ghost text-gray-500 hover:bg-rose-100">Cancelar</button>
            <button @click="executeDelete" type="button" class="btn bg-rose-500 hover:bg-rose-600 text-white border-none" :disabled="form.processing">
              Sí, borrar reseña
            </button>
          </div>
        </div>

        <div v-else class="bg-white p-6 rounded-xl border border-rose-100 shadow-sm">
          <h4 class="text-lg font-bold mb-4 text-rose-500">
            {{ myExistingReview ? 'Edita tu Reseña' : 'Deja tu opinión' }}
          </h4>

          <form @submit.prevent="submitReview">
            <div class="rating mb-4">
              <input type="radio" v-model="form.rating" :value="1" class="mask mask-star-2 bg-orange-300" />
              <input type="radio" v-model="form.rating" :value="2" class="mask mask-star-2 bg-orange-300" />
              <input type="radio" v-model="form.rating" :value="3" class="mask mask-star-2 bg-orange-300" />
              <input type="radio" v-model="form.rating" :value="4" class="mask mask-star-2 bg-orange-300" />
              <input type="radio" v-model="form.rating" :value="5" class="mask mask-star-2 bg-orange-300" />
            </div>

            <textarea
                v-model="form.comment"
                class="textarea textarea-bordered w-full bg-white text-gray-800 mb-4 border-rose-200 focus:border-rose-400 focus:ring-rose-200"
                placeholder="¿Qué te pareció el libro?"
                required
            ></textarea>

            <div class="flex justify-between items-center">
              <button type="submit" class="btn bg-rose-400 hover:bg-rose-500 text-white border-none" :disabled="form.processing">
                {{ myExistingReview ? 'Actualizar Reseña' : 'Publicar Reseña' }}
              </button>

              <button
                  v-if="myExistingReview"
                  type="button"
                  @click="showConfirmDelete = true"
                  class="btn btn-outline btn-error btn-sm"
              >
                Borrar
              </button>
            </div>
          </form>
        </div>

      </div>

      <div v-else class="text-center p-4 bg-rose-50 rounded-lg text-gray-500">
        Debes iniciar sesión para escribir una reseña.
      </div>

    </div>
    <form method="dialog" class="modal-backdrop">
      <button @click="emit('close')">close</button>
    </form>
  </dialog>
</template>