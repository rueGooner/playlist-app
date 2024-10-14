<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';

interface FormState {
  file_upload: File | null; // File type or null if no file is selected
}

const form = useForm<FormState>({
  file_upload: '',
  catalog_name: 'Test Catalogue'
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
</script>

<template>
  <form @submit.prevent="handleFileUpload" class="bg-secondary px-4 py-6">
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
