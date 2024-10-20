<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
  href: string;
  title: string;
}>();
</script>

<template>
  <Link :href="href"
        class="tile bg-secondary text-white p-4 rounded-lg shadow hover:shadow-lg hover:bg-primary hover:text-highlight cursor-pointer transition-shadow duration-200 flex flex-col items-center justify-center">
    <div class="flex flex-col items-center space-x-2">
      <slot name="icon"></slot>
      <h3 class="text-xl font-light">{{ title }}</h3>
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
