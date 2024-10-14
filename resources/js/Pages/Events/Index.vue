<template>
  <Head title="Manage Events"/>

  <AuthenticatedLayout>
    <template #header>
      <h2
        class="text-xl font-semibold leading-tight text-slate-200"
      >
        Event Management
      </h2>
    </template>
    <div class="relative overflow-x-auto py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <table class="w-full text-sm text-left rtl:text-right text-primary shadow-lg">
          <thead class="text-secondary uppercase bg-primary">
          <tr>
            <th scope="col" class="px-6 py-3">Event Title</th>
            <th scope="col" class="px-6 py-3">Organizer</th>
            <th scope="col" class="px-6 py-3">Event Date</th>
            <th scope="col" class="px-6 py-3">Start Time</th>
            <th scope="col" class="px-6 py-3">End Time</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="event in events" :key="event.id" class="bg-slate-800 border-b text-white">
            <th scope="row" class="px-6 py-4 font-medium text-sm whitespace-nowap text-accent">{{
                event.title
              }}</th>
            <td class="px-6 py-3 font-medium text-sm text-white whitespace-nowrap">{{ event.user.name }}</td>
            <td class="px-6 py-3 font-medium text-sm text-white whitespace-nowrap">{{ formatDate(event.event_date)
              }}</td>
            <td class="px-6 py-3 font-medium text-sm text-white whitespace-nowrap">{{ formatTime(event.start_time)
              }}</td>
            <td class="px-6 py-3 font-medium text-sm text-white whitespace-nowrap">{{ formatTime(event.end_time) }}</td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup lang="ts">
import { defineProps } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

interface Event {
  id: number;
  title: string;
  event_date: string | Date;
  start_time: string | Date;
  end_time: string | Date;
  user: {
    name: string;
  };
}

const props = defineProps<{ events: Event[] }>()

const formatDate = (date: string | Date): string => {
  const parsedDate = new Date(date);
  return !isNaN(parsedDate.getTime()) ? parsedDate.toLocaleDateString() : 'Invalid Date';
};

const formatTime = (time: string | Date): string => {
  const parsedTime = new Date(time);
  return !isNaN(parsedTime.getTime())
    ? parsedTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
    : 'Invalid Time';
};

</script>
