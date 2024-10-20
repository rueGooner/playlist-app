<script setup lang="ts">

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Tile from '@/Components/Tile.vue';
import { Icon } from '@iconify/vue';
</script>

<template>
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
          <PrimaryButton @click="setModalContent('new-user');"
                         class="flex flex-col items-center justify-center">
            <div class="flex flex-col items-center space-x-2">
              <Icon icon="mdi:account-box-plus-outline" class="text-3xl font-light"/>
              <h3 class="text-xl font-light">Create New User</h3>
            </div>
          </PrimaryButton>
          <PrimaryButton @click="setModalContent('new-event');"
                         class="flex flex-col items-center justify-center">
            <div class="flex flex-col items-center space-x-2">
              <Icon icon="mdi:calendar-plus" class="text-3xl font-light"/>
              <h3 class="text-xl font-light">Create New Event</h3>
            </div>
          </PrimaryButton>
          <!--            <PrimaryButton @click="setModalContent('file-upload');"-->
          <!--                           class="flex flex-col items-center justify-center">-->
          <!--              <div class="flex flex-col items-center space-x-2">-->
          <!--                <Icon icon="mdi:music-box-multiple-outline" class="text-3xl font-light"/>-->
          <!--                <h3 class="text-xl font-light">Upload Catalogue</h3>-->
          <!--              </div>-->
          <!--            </PrimaryButton>-->
          <Tile title="Manage Events" href="/events">
            <template #icon>
              <Icon icon="mdi:clipboard-text" class="text-3xl"/>
            </template>
          </Tile>
          <Tile title="Client Management" href="/client">
            <template #icon>
              <Icon icon="mdi:account-group" class="text-3xl"/>
            </template>
          </Tile>
          <Tile title="Catalogue" href="/catalogue">
            <template #icon>
              <Icon icon="mdi:music-box" class="text-3xl"/>
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
