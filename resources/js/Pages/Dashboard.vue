<script setup lang="ts">
import { defineComponent, ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Tile from '@/Components/Tile.vue';
import { Icon } from '@iconify/vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';
import CreateEvent from '@/Components/CreateEvent.vue';

const newEventModal = ref(false);

const displayNewEventModal = (displayValue) => {
  newEventModal.value = displayValue;
};

defineComponent({
  name: 'Dashboard',
  components: {
    Tile,
    Icon,
  },
  methods: {
    navigateTo(route: string) {
      this.$inertia.visit(route);
    },
  },
});
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
<!--            <Tile title="Create an Event" href="/events/create">-->
<!--              <template #icon>-->
<!--                <Icon icon="mdi:calendar-plus" class="text-2xl font-light"/>-->
<!--              </template>-->
<!--            </Tile>-->
            <PrimaryButton @click="displayNewEventModal(true)">
              DISPLAY
            </PrimaryButton>
            <Tile title="Manage Events" icon="📋" href="/events">
              <template #icon>
                <Icon icon="mdi:clipboard-text" class="text-3xl"/>
              </template>
            </Tile>
            <Tile title="Client Management" icon="👥" href="/client">
              <template #icon>
                <Icon icon="mdi:account-group" class="text-3xl"/>
              </template>
            </Tile>
            <Tile title="Analytics" icon="📊" href="/analytics">
              <template #icon>
                <Icon icon="mdi:chart-line" class="text-3xl"/>
              </template>
            </Tile>
          </div>
        </div>
      </div>
    </div>
    <Modal :show="true">
      <CreateEvent />
    </Modal>
  </AuthenticatedLayout>
</template>
