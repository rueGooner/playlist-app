<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
  href: string;
  title: string;
}>();
</script>

<template>
  <Link :href="href" class="tile bg-white p-4 rounded-lg shadow hover:shadow-lg cursor-pointer">
    <div class="flex items-center">
      <slot name="icon"></slot>
      <h3 class="text-xl font-semibold">{{ title }}</h3>
    </div>
  </Link>
</template>

<style scoped>
.tile {
  transition: transform 0.2s;
}

.tile:hover {
  transform: scale(1.05);
}
</style>
