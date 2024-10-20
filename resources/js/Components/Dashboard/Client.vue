<script setup lang="ts">

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Tile from '@/Components/Tile.vue';
import { Icon } from '@iconify/vue';
</script>

<template>
  <Head title="Dashboard"/>
  <AuthenticatedLayout>
    <template #header>
      <h2
        class="text-xl font-semibold leading-tight"
      >
        Dashboard
      </h2>
    </template>
    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div
          class="overflow-hidden shadow-sm rounded"
        >
          <div class="p-6 text-primary">
            A welcome message of some sort.
          </div>
          <div class="dashboard grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 p-6 bg-highlight">
            <Tile title="My Events" href="/events">
              <template #icon>
                <Icon icon="mdi:clipboard-text" class="text-3xl"/>
              </template>
            </Tile>
            <Tile title="My Playlists" href="/client">
              <template #icon>
                <Icon icon="mdi:account-group" class="text-3xl"/>
              </template>
            </Tile>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>

</style>
