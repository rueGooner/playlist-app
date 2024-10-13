<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const form = useForm({

});
</script>

<template>
  <Head title="Create an Event" />
  <AuthenticatedLayout>
    <template #header>
      <h2
        class="text-xl font-semibold leading-tight text-slate-200"
      >
        Create Event
      </h2>
    </template>

    <div class="relative mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="bg-slate-200 text-slate-600">
        <div class="relative flex min-h-screen flex-col items-center justify-center">
          <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
            <main>
              You will create a new event here.
            </main>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
