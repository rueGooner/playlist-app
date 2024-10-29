<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue';

const props = defineProps<{
  message: string;
}>();

const visible = ref(true);
const hideNotification = () => {
  visible.value = false;
};

onMounted(() => {
  setTimeout(hideNotification, 14000);
});

onUnmounted(() => {
  visible.value = false; // Make sure to clean up if needed
});
</script>

<template>
<div v-if="visible" class="bg-primary absolute top-10 right-10">
  {{ message }}
</div>
</template>
