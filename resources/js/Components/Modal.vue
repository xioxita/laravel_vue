<script setup>
import { watch, onMounted, onUnmounted } from 'vue';

const props = defineProps({
  show: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(['close']);

// Bloquear el scroll del fondo cuando el modal está abierto
watch(
    () => props.show,
    (show) => {
      document.body.style.overflow = show ? 'hidden' : '';
    }
);

const closeOnEscape = (e) => {
  if (e.key === 'Escape' && props.show) {
    emit('close');
  }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));
onUnmounted(() => {
  document.removeEventListener('keydown', closeOnEscape);
  document.body.style.overflow = '';
});
</script>

<template>
  <Teleport to="body">
    <div
        v-if="show"
        class="modal modal-open z-[9999] bg-black/60"
        @click.self="$emit('close')"
    >
      <div class="modal-box relative bg-white text-gray-900 shadow-2xl">
        <button
            @click="$emit('close')"
            class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 text-gray-500 hover:bg-gray-200"
        >
          ✕
        </button>

        <slot />
      </div>
    </div>
  </Teleport>
</template>