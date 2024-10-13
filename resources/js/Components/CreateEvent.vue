<script setup lang="ts">
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Checkbox from '@/Components/Checkbox.vue';

const isExistingClient = ref(false);

const form = useForm({
  title: '',
  date: '',
  start_time: '',
  end_time: '',
  address: '',
});

const fetchExistingClients = async () => {
  if (isExistingClient.value) {
    const response = await axios.get('/api/users');
    console.log('response', response);
  }
}

watch(isExistingClient, fetchExistingClients);

const handleSubmit = () => {
  form.post(route('events.store'), {
    onFinish: () => {
      form.reset();
    }
  });
};
</script>

<template>
  <form @submit.prevent="handleSubmit" class="bg-secondary px-4 py-6">
    <div class="mt-2 block">
      <label class="flex items-center">
        <Checkbox name="existingClient" v-model:checked="isExistingClient"/>
        <span class="ms-2 text-sm text-slate-600"
        >Remember me</span
        >
      </label>
    </div>
    <div v-if="isExistingClient">
      <div class="mt-4 text-white">
        <InputLabel for="title" value="Event Title"/>
        <TextInput model-value="title" class="w-full border-accent focus:border-primary focus:ring-primary"/>
        <InputError class="mt-2" :message="form.errors.title"/>
      </div>
      <div class="mt-4 text-white">
        <InputLabel for="title" value="Event Title"/>
        <TextInput model-value="title" type="time"
                   class="w-full border-accent focus:border-primary focus:ring-primary"/>
      </div>
    </div>
    <div>
      <div class="mt-4 text-white">
        <InputLabel for="title" value="Event Title"/>
        <TextInput model-value="title" class="w-full border-accent focus:border-primary focus:ring-primary"/>
        <InputError class="mt-2" :message="form.errors.title"/>
      </div>
      <div class="mt-4 text-white">
        <InputLabel for="title" value="Event Title"/>
        <TextInput model-value="title" type="time" class="w-full border-accent focus:border-primary focus:ring-primary"/>
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
