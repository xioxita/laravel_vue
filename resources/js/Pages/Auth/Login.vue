<script setup>
import { useForm } from '@inertiajs/vue3';

const emit = defineEmits(['close']);

defineProps({
  status: { type: String },
});

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
    // Al finalizar con éxito, cerramos el modal
    onSuccess: () => emit('close'),
  });
};
</script>

<template>
  <div class="w-full">
    <h3 class="font-bold text-2xl text-center mb-6 text-blue-900">Iniciar Sesión</h3>

    <div v-if="status" class="mb-4 text-sm font-medium text-green-600 text-center">
      {{ status }}
    </div>

    <form @submit.prevent="submit" class="flex flex-col gap-4">

      <div class="form-control">
        <label class="label">
          <span class="label-text font-semibold">Correo Electrónico</span>
        </label>
        <input
            type="email"
            placeholder="email@ejemplo.com"
            class="input input-bordered w-full bg-white text-gray-900"
            v-model="form.email"
            required
            autofocus
        />
        <span v-if="form.errors.email" class="text-error text-xs mt-1">{{ form.errors.email }}</span>
      </div>

      <div class="form-control">
        <label class="label">
          <span class="label-text font-semibold">Contraseña</span>
        </label>
        <input
            type="password"
            placeholder="••••••••"
            class="input input-bordered w-full bg-white text-gray-900"
            v-model="form.password"
            required
        />
        <span v-if="form.errors.password" class="text-error text-xs mt-1">{{ form.errors.password }}</span>
      </div>

      <div class="form-control">
        <label class="label cursor-pointer justify-start gap-2">
          <input
              type="checkbox"
              class="checkbox checkbox-primary checkbox-sm"
              v-model="form.remember"
          />
          <span class="label-text text-gray-600">Recordarme</span>
        </label>
      </div>

      <div class="form-control mt-4">
        <button
            class="btn btn-primary w-full text-white text-lg"
            :class="{ 'loading': form.processing }"
            :disabled="form.processing"
        >
          Entrar
        </button>
      </div>

      <button
          type="button"
          class="btn btn-ghost btn-sm text-gray-500 mt-2"
          @click="emit('close')"
      >
        Cancelar y volver
      </button>
    </form>
  </div>
</template>