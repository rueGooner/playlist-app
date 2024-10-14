<script setup lang="ts">
import { defineComponent, ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Tile from '@/Components/Tile.vue';
import { Icon } from '@iconify/vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';
import CreateEvent from '@/Components/CreateEvent.vue';

const modalContent = ref<string | null>(null);
const modalDisplay = ref(false);

const setModalContent = (content: string) => {
  modalDisplay.value = true;
  if (modalDisplay) {
    modalContent.value = content;
  }
};

const closeModal = () => {
  modalDisplay.value = false;
  modalContent.value = null;
}

const logModalContent = () => {
  console.log(modalContent.value); // Log modal content when opened
};

</script>

<template>
  <Head title="Dashboard"/>

  <AuthenticatedLayout>
    <template #header>
      <h2
        class="text-xl font-semibold leading-tight text-slate-200"
      >
        Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div
          class="overflow-hidden shadow-sm rounded bg-slate-600"
        >
          <div class="p-6 text-slate-600 bg-slate-200">
            A welcome message of some sort.
          </div>
          <div class="dashboard grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 p-6">
            <PrimaryButton @click="setModalContent('new-event'); logModalContent()"
                           class="flex flex-col items-center justify-center">
              <div class="flex flex-col items-center space-x-2">
                <Icon icon="mdi:calendar-plus" class="text-3xl font-light"/>
                <h3 class="text-xl font-light">Create New Event</h3>
              </div>
            </PrimaryButton>
            <PrimaryButton @click="setModalContent('new-catalogue'); logModalContent()"
                           class="flex flex-col items-center justify-center">
              <div class="flex flex-col items-center space-x-2">
                <Icon icon="mdi:music-box-multiple-outline" class="text-3xl font-light"/>
                <h3 class="text-xl font-light">New Catalogue</h3>
              </div>
            </PrimaryButton>
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
            <Tile title="Analytics" href="/analytics">
              <template #icon>
                <Icon icon="mdi:chart-line" class="text-3xl"/>
              </template>
            </Tile>
          </div>
        </div>
      </div>
    </div>
    <Modal :show="modalDisplay" @close="closeModal">
      <CreateEvent v-if="modalContent === 'new-event'"/>
      <div v-if="modalContent === 'new-catalogue'">
        CREATE NEW CATALOGUE
      </div>
    </Modal>
  </AuthenticatedLayout>
</template>
