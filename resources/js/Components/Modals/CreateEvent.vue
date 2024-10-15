<script setup lang="ts">
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Checkbox from '@/Components/Checkbox.vue';
import AutoComplete from '@/Components/AutoComplete.vue';
import axios from 'axios';

interface User {
  id: number;
  name: string;
  email: string;
}

const isExistingClient = ref(false);
const existingUsers = ref<{ id: number; name: string; email: string; }[]>([]);
const form = useForm({
  title: '',
  user_name: '',
  user_email: '',
  date: '',
  start_time: '1',
  end_time: '',
  address: '',
});

const fetchExistingClients = async () => {
  if (isExistingClient.value) {
    const response = await axios.get('/api/users');
    existingUsers.value = response.data;
  }
}

watch(isExistingClient, fetchExistingClients);

const handleSubmit = () => {
  form.post(route('events.create'), {
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
      <PrimaryButton class="ms-4">
        Create
      </PrimaryButton>
    </div>
  </form>
</template>

<style scoped>

</style>
