<script setup>
import { useForm } from '@inertiajs/vue3';
const emit = defineEmits(['close']);
defineProps({ status: String });

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password'),
    onSuccess: () => emit('close'),
  });
};
</script>

<template>
  <div class="w-full">
    <h3 class="font-bold text-2xl text-center mb-6 text-rose-500">Registro de usuario</h3>

    <div v-if="status" class="mb-4 text-sm font-medium text-green-600 text-center">
      {{ status }}
    </div>

    <form @submit.prevent="submit" class="flex flex-col gap-4">

      <div class="form-control">
        <label class="label"><span class="label-text font-semibold text-gray-700">Nombre</span></label>
        <input type="name" placeholder="tu nombre" class="input input-bordered w-full bg-orange-50 border-rose-200 text-gray-900 focus:border-rose-400 focus:ring-rose-400" v-model="form.name" required autofocus />
        <span v-if="form.errors.name" class="text-error text-xs mt-1">{{ form.errors.name}}</span>
      </div>

      <div class="form-control">
        <label class="label"><span class="label-text font-semibold text-gray-700">Correo Electrónico</span></label>
        <input type="email" placeholder="email@ejemplo.com" class="input input-bordered w-full bg-orange-50 border-rose-200 text-gray-900 focus:border-rose-400 focus:ring-rose-400" v-model="form.email" required autofocus />
        <span v-if="form.errors.email" class="text-error text-xs mt-1">{{ form.errors.email }}</span>
      </div>

      <div class="form-control">
        <label class="label"><span class="label-text font-semibold text-gray-700">Contraseña</span></label>
        <input type="password" placeholder="••••••••" class="input input-bordered w-full bg-orange-50 border-rose-200 text-gray-900 focus:border-rose-400" v-model="form.password" required />
        <span v-if="form.errors.password" class="text-error text-xs mt-1">{{ form.errors.password }}</span>
      </div>

      <div class="form-control">
        <label class="label"><span class="label-text font-semibold text-gray-700">Confirme contraseña</span></label>
        <input type="password" placeholder="••••••••" class="input input-bordered w-full bg-orange-50 border-rose-200 text-gray-900 focus:border-rose-400" v-model="form.password_confirmation" required />
        <span v-if="form.errors.password_confirmation" class="text-error text-xs mt-1">{{ form.errors.password_confirmation }}</span>
      </div>

      <div class="form-control">
        <label class="label cursor-pointer justify-start gap-2">
          <input type="checkbox" class="checkbox checkbox-primary checkbox-sm border-rose-300 checked:bg-rose-500" v-model="form.remember" />
          <span class="label-text text-gray-600">Recordarme</span>
        </label>
      </div>

      <div class="form-control mt-4">
        <button class="btn bg-rose-400 hover:bg-rose-500 text-white border-none w-full text-lg rounded-full" :class="{ 'loading': form.processing }" :disabled="form.processing">
          Entrar
        </button>
      </div>

      <button type="button" class="btn btn-ghost btn-sm text-gray-500 mt-2 hover:bg-rose-50" @click="emit('close')">
        Cancelar y volver
      </button>
    </form>
  </div>
</template>