<script setup lang="ts">
import { ref, computed, defineProps, defineEmits, onMounted, onBeforeUnmount } from 'vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Icon } from '@iconify/vue';

interface User {
  id: number;
  name: string;
  email: string;
}

const props = defineProps<{
  users: User[]
}>();

const emit = defineEmits<{
  (event: 'update:user_id', value: User | null): void
}>()

const searchTerm = ref('');
const selectedUser = ref('');

const searchUsers = computed(() => {
  if (searchTerm.value === '') return [];
  let matches = 0;

  return props.users.filter(user => {
    if (user.name.toLowerCase().includes(searchTerm.value.toLowerCase()) && matches < 10) {
      matches++;
      return user;
    }
  })
})

const handleUserSelection = (user: User) => {
  selectedUser.value = user.name;
  searchTerm.value = '';
  emit('update:user_id', user);
}

const removeSelectedUser = () => {
  selectedUser.value = '';
  emit('update:user_id', null);
}
</script>

<template>
  <div class="relative flex items-center justify-between">
    <div class="w-full flex flex-col">
      <InputLabel for="existing-user" value="Event Owner"/>
      <div class="relative">
        <TextInput v-model="searchTerm" type="search" class="w-full border-secondary"/>
        <ul v-if="searchUsers.length"
            class="absolute z-10 bg-white border border-secondary mt-1 rounded shadow-lg overflow-y-scroll h-52">
          <li v-for="user in searchUsers" :key="user.email" class="p-2 hover:bg-gray-200 cursor-pointer"
              @click="handleUserSelection(user)">
            {{ user.name }} ({{ user.email }})
          </li>
        </ul>
        <div class="absolute top-2 left-2">
          <p v-if="selectedUser"
             class="items-center bg-primary inline-flex text-white rounded text-sm px-2 py-1 font-bold">
            {{ selectedUser }}
            <Icon icon="mdi:close"
                  class="border rounded ml-8 hover:border-secondary hover:text-secondary cursor-pointer font-bold"
                  @click="removeSelectedUser()" />
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Add styles if needed */
</style>
