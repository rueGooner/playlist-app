<script setup lang="ts">
import { computed, ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { NewUser } from '../../../types/users.interface';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputSuccess from '@/Components/InputSuccess.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const password_confirmation = ref<string>('');
const form = useForm<NewUser>({
  first_name: '',
  last_name: '',
  password: '',
  role: '',
});

const hasStartedTypingConfirmation = ref<boolean>(false);

watch(password_confirmation, (newValue) => {
  if (newValue !== '') {
    hasStartedTypingConfirmation.value = newValue.length > 0;
  }
});

// Computed property to check if passwords match
const passwordsMatch = computed(() => {
  if (!hasStartedTypingConfirmation.value) {
    return true; // Before typing in confirmation, we assume they match.
  }
  return form.password.length !== 0 && form.password === password_confirmation.value;
});

// Computed property to check if feedback should be shown (when both fields are not empty)
const shouldShowFeedback = computed(() => {
  return form.password.length > 0 && password_confirmation.value.length > 0;
});
</script>

<template>
  <form @submit.prevent class="bg-secondary px-4 py-6">
    <h3 class="text-xl">Create New User</h3>
    <div class="grid grid-cols-2 gap-6 mt-2">
      <div class="mt-2">
        <InputLabel for="first_name" value="First Name"/>
        <TextInput v-model="form.first_name" class="w-full border-accent focus:border-primary focus:ring-transparent"/>
      </div>
      <div class="mt-2">
        <InputLabel for="last_name" value="Surname"/>
        <TextInput v-model="form.last_name" class="w-full border-accent focus:border-primary focus:ring-transparent"/>
      </div>
    </div>
    <div class="grid grid-cols-2 gap-6 mt-2">
      <div class="mt-2">
        <InputLabel for="password" value="Password"/>
        <TextInput v-model="form.password" class="w-full border-accent focus:border-primary focus:ring-transparent"/>
        <InputError v-if="shouldShowFeedback && !passwordsMatch" class="mt-1" message="Passwords do not match!"/>
        <InputSuccess v-if="shouldShowFeedback && passwordsMatch" class="mt-1"
                      message="Passwords match."/>
      </div>
      <div class="mt-2">
        <InputLabel for="password_confirmation" value="Password Confirmation"/>
        <TextInput v-model="password_confirmation"
                   class="w-full border-accent focus:border-primary focus:ring-transparent"/>
      </div>
      <div class="mt-2">
        <InputLabel for="role" value="User Type" />
        <select v-model="form.role" class="rounded-md border-accent w-full text-primary">
          <option disabled value="">User Role</option>
          <option value="dj">DJ</option>
          <option value="client">Client</option>
        </select>
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
