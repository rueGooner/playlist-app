<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import AutoComplete from '@/Components/AutoComplete.vue';
import { onMounted, ref } from 'vue';
import axios from 'axios';

interface User {
  id: number;
  name: string;
  email: string;
}

interface FormState {
  file_upload: File | null;
  catalog_name: string;
  user_id: number | null;
}

const existingUsers = ref<User[]>([]);
const form = useForm<FormState>({
  file_upload: '',
  catalog_name: 'Test Catalogue',
  user_id: null
});

onMounted(async () => {
  const response = await axios.get('/api/users');
  existingUsers.value = response.data;
});

const handleFileUpload = () => {
  form.post(route('api.uploads'), {
    onError: (errors) => {
      console.error(errors)
    }
  });
}

const handleFileChange = (event: Event) => {
  const target = event.target as HTMLInputElement;
  form.file_upload = target.files?.[0];
}

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
  <form @submit.prevent="handleFileUpload" class="bg-secondary px-4 py-6">
    <div class="mt-2 text-primary max-w-md mx-auto">
      <AutoComplete :users="existingUsers" @update:user_id="handleExistingUser" />
    </div>
    <div class="mt-4 text-primary max-w-md mx-auto">
      <InputLabel for="catalog_name" value="Catalog Name"/>
      <TextInput v-model="form.catalog_name" class="w-full border-accent focus:border-primary focus:ring-primary"/>
      <InputError class="mt-2" :message="form.errors.catalog_name"/>
    </div>
    <div class="font-[sans-serif] max-w-md mx-auto mt-4">
      <InputLabel class="text-base text-gray-500 font-semibold mb-2 block">Upload file</InputLabel>
      <input @change="handleFileChange" type="file"
                 class="w-full text-primary font-semibold text-sm bg-white border file:cursor-pointer cursor-pointer file:border-0 file:py-3 file:px-4 file:mr-4 file:bg-accent file:text-white file:hover:bg-highlight rounded"/>
      <p class="text-xs text-primary mt-2">Only CSV files are allowed.</p>
    </div>
    <div class="mt-4 flex justify-end">
      <PrimaryButton class="ms-4">
        Upload
      </PrimaryButton>
    </div>
  </form>
</template>
