<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { computed } from 'vue';

const page = usePage();
const isAdmin = computed(() => page.props.auth.user?.role === 'admin');
</script>

<template>
  <nav class="bg-white/80 backdrop-blur-md border-b border-rose-100 sticky top-0 z-50">
    <div class="container mx-auto px-4">
      <div class="flex h-12 items-center justify-between">
        <div>
          <Link
              v-if="isAdmin"
              :href="route('admin.dashboard')"
              class="btn btn-secondary btn-xs sm:btn-sm text-white font-bold rounded-full shadow-sm"
          >
            Panel Admin
          </Link>
        </div>

      </div>
    </div>
  </nav>
</template>