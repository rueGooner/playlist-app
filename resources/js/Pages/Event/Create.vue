<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
  canLogin?: boolean;
  canRegister?: boolean;
  laravelVersion: string;
  phpVersion: string;
}>();

function handleImageError() {
  document.getElementById('screenshot-container')?.classList.add('!hidden');
  document.getElementById('docs-card')?.classList.add('!row-span-1');
  document.getElementById('docs-card-content')?.classList.add('!flex-row');
  document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
  <Head title="Welcome" />
  <div class="bg-slate-200 text-slate-600">
    <div class="relative flex min-h-screen flex-col items-center justify-center">
      <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
        <main>
          You will create a new event here.
        </main>
      </div>
    </div>
  </div>
</template>
