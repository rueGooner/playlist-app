<script setup lang="ts">
defineProps<{
  message?: string;
}>();
</script>

<template>
  <div v-show="message">
    <p class="inline p-1 text-sm bg-teal-600 dark:bg-teal-400 text-white rounded">
      {{ message }}
    </p>
  </div>
</template>
