<script setup lang="ts">
import { computed } from 'vue';
import AdminDashboard from '@/Components/Dashboard/Admin.vue';
import DJDashboard from '@/Components/Dashboard/DJ.vue';
import ClientDashboard from '@/Components/Dashboard/Client.vue';
import Notification from '@/Components/Notification.vue';

const props = defineProps<{ role: string, message: string }>();

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
  <div class="relative">
    <component :is="currentDashboard" />
    <Notification v-if="message" :message="message" />
  </div>
</template>
