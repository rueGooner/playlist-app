<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const form = useForm({
  file_upload: '',
});

const handleFileUpload = () => {
  form.post(route('api.uploads'));
}
</script>

<template>
  <form @submit.prevent="handleFileUpload" class="bg-secondary px-4 py-6">
    <div class="font-[sans-serif] max-w-md mx-auto">
      <InputLabel class="text-base text-gray-500 font-semibold mb-2 block">Upload file</InputLabel>
      <TextInput v-model="form.file_upload" type="file"
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
