<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Checkbox from '@/Components/Checkbox.vue';
import { ref, watch, computed } from 'vue';

const isDJ = ref<boolean>(false);

const form = useForm({
  name: '',
  first_name: '',
  last_name: '',
  email: '',
  password: '',
  password_confirmation: '',
  role: 'client'
});

const submit = () => {
  form.post(route('register'), {
    onFinish: () => {
      form.reset('password', 'password_confirmation');
    },
  });
};

const hasStartedTypingConfirmation = ref<boolean>(false);

watch(() => form.password_confirmation, (newValue) => {
  if (newValue !== '') {
    hasStartedTypingConfirmation.value = newValue.length > 0;
  }
});

watch(isDJ, (newValue) => {
  form.role = newValue ? 'dj' : 'client';
});

// Computed property to check if passwords match
const passwordsMatch = computed(() => {
  if (!hasStartedTypingConfirmation.value) {
    return true; // Before typing in confirmation, we assume they match.
  }
  return form.password.length !== 0 && form.password === form.password_confirmation;
});

// Computed property to check if feedback should be shown (when both fields are not empty)
const shouldShowFeedback = computed(() => {
  return form.password.length > 0 && form.password_confirmation.length > 0;
});
</script>

<template>
  <GuestLayout>
    <Head title="Register"/>

    <form @submit.prevent="submit">
      <div class="grid grid-cols-2 gap-6 mb-2">
        <div>
          <InputLabel for="first_name" value="First Name"/>

          <TextInput
            id="first_name"
            type="text"
            class="mt-1 w-full border-secondary focus:border-highlight focus:ring-highlight"
            v-model="form.name"
            required
            autofocus
            autocomplete="name"
          />

          <InputError class="mt-2" :message="form.errors.first_name"/>
        </div>
        <div>
          <InputLabel for="last_name" value="Last Name"/>

          <TextInput
            id="last_name"
            type="text"
            class="mt-1 w-full border-secondary focus:border-highlight focus:ring-highlight"
            v-model="form.first_name"
            required
            autofocus
            autocomplete="name"
          />

          <InputError class="mt-2" :message="form.errors.last_name"/>
        </div>
      </div>

      <div>
        <InputLabel for="name" value="Username"/>

        <TextInput
          id="username"
          type="text"
          class="mt-1 w-full border-secondary focus:border-highlight focus:ring-highlight"
          v-model="form.last_name"
          required
          autofocus
          autocomplete="name"
        />

        <InputError class="mt-2" :message="form.errors.name"/>
      </div>

      <div class="mt-4">
        <InputLabel for="email" value="Email"/>

        <TextInput
          id="email"
          type="email"
          class="mt-1 w-full border-secondary focus:border-highlight focus:ring-highlight"
          v-model="form.email"
          required
          autocomplete="username"
        />

        <InputError class="mt-2" :message="form.errors.email"/>
      </div>

      <div class="mt-4">
        <InputLabel for="password" value="Password" class="inline-block rounded mb-0" :class="{
          'text-white bg-red-400 px-2 py-1 mb-0': shouldShowFeedback && !passwordsMatch,
          'text-white bg-teal-400 px-2 py-1 mb-0': shouldShowFeedback && passwordsMatch
        }"/>

        <TextInput
          id="password"
          type="password"
          class="mt-1 w-full border-secondary focus:border-highlight focus:ring-highlight"
          v-model="form.password"
          required
          autocomplete="new-password"
        />

        <InputError class="mt-2" :message="form.errors.password"/>
      </div>

      <div class="mt-4 ">
        <InputLabel for="password_confirmation" value="Confirm Password" class="inline-block rounded mb-0" :class="{
          'text-white bg-red-400 px-2 py-1 mb-0': shouldShowFeedback&& !passwordsMatch,
          'text-white bg-teal-400 px-2 py-1 mb-0': shouldShowFeedback && passwordsMatch
        }"/>

        <TextInput
          id="password_confirmation"
          type="password"
          class="mt-1 w-full border-secondary focus:border-highlight focus:ring-highlight"
          v-model="form.password_confirmation"
          required
          autocomplete="new-password"
        />
      </div>

      <div class="mt-2">
        <div class="mt-4 block">
          <label class="flex items-center">
            <Checkbox name="remember" v-model:checked="isDJ"/>
            <span class="ms-2 text-sm text-slate-600">
            DJ
          </span>
          </label>
        </div>
      </div>

      <div class="mt-2 flex items-center justify-end">
        <Link
          :href="route('login')"
          class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
        >
          Already registered?
        </Link>

        <PrimaryButton
          class="ms-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Register
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>
