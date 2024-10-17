<script setup lang="ts">
import { computed } from 'vue';
import AdminDashboard from '@/Components/Dashboard/Admin.vue';
import DJDashboard from '@/Components/Dashboard/DJ.vue';
import ClientDashboard from '@/Components/Dashboard/Client.vue';

const props = defineProps<{ role: string }>();

const currentDashboard = computed(() => {
  switch (props.role) {
    case 'admin':
      return AdminDashboard;
    case 'dj':
      return DJDashboard;
    case 'client':
      return ClientDashboard;
    default:
      return null;
  }
});
</script>

<template>
  <component :is="currentDashboard" />
</template>
