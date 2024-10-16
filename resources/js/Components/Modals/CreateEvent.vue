<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AutoComplete from '@/Components/AutoComplete.vue';
import axios from 'axios';
import { Icon } from '@iconify/vue';

interface User {
  id: number;
  name: string;
  email: string;
}

const existingUsers = ref<User[]>([]);
const form = useForm({
  title: '',
  user_name: '',
  user_email: '',
  date: '',
  start_time: '1',
  end_time: '',
  address: '',
});

onMounted(async () => {
  const response = await axios.get('/api/users');
  existingUsers.value = response.data.filter(user => user.role ==='client');
});

const handleSubmit = () => {
  form.post(route('events.store'), {
    onError: () => {
      console.log(form.errors);
    },
    onFinish: () => {
      form.reset();
    }
  });
};

const handleExistingUser = (user: User | null) => {
  if (user) {
    form.user_email = user.email;
    form.user_name = user.name;
  } else {
    form.user_name = '';
    form.user_email = '';
  }
}
</script>

<template>
  <form @submit.prevent="handleSubmit" class="bg-secondary px-4 py-6">
    <div class="flex grid grid-cols-2 gap-6">
      <AutoComplete :users="existingUsers" @update:user_id="handleExistingUser" />
      <div class="text-primary">
        <InputLabel for="title" value="Event Title"/>
        <TextInput v-model="form.title" class="w-full border-accent focus:border-primary focus:ring-primary"/>
        <InputError class="mt-2" :message="form.errors.title"/>
      </div>
    </div>
    <div>
      <div class="mt-4 text-primary inline-flex grid grid-cols-3 gap-6">
        <div class="relative w-full">
          <InputLabel for="date" value="Event Date"/>
          <TextInput v-model="form.date" type="date"
                     class="w-full border-accent focus:border-primary focus:ring-primary"/>
          <InputError class="mt-2" :message="form.errors.date"/>
        </div>
        <div class="relative w-full">
          <InputLabel for="start_time" value="Start Time"/>
          <TextInput v-model="form.start_time" type="time"
                     class="w-full border-accent focus:border-primary focus:ring-highlight"/>
          <InputError class="mt-2" :message="form.errors.start_time"/>
        </div>
        <div class="w-full">
          <InputLabel for="end_time" value="End Time"/>
          <TextInput v-model="form.end_time" type="time"
                     class="w-full border-accent focus:border-primary focus:ring-highlight"/>
          <InputError class="mt-2" :message="form.errors.end_time"/>
        </div>
      </div>
      <div class="mt-4 text-primary">
        <InputLabel for="address" value="Address" />
        <textarea class="rounded-md border-accent w-full resize-none shadow-sm" rows="4" v-model="form.address"></textarea>
      </div>
    </div>
    <div class="mt-4 flex justify-end">
      <div v-if="selectedUser"  class="flex flex-col items-end justify-end">
        <InputLabel for="existing-user" value="New event for"/>
        <p
          class="flex items-center bg-highlight inline-flex text-white rounded text-sm px-2 py-1 font-bold">
          {{ selectedUser }}
          <Icon icon="mdi:close"
                class="border rounded ml-8 hover:border-accent hover:text-accent cursor-pointer font-bold"
                @click="removeSelectedUser()" />
        </p>
      </div>
      <PrimaryButton class="ms-4">
        Create
      </PrimaryButton>
    </div>
  </form>
</template>

<style scoped>

</style>
