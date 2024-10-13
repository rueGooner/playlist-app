<script setup lang="ts">
import { ref, computed, defineProps, defineEmits, onMounted, onBeforeUnmount } from 'vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Icon } from '@iconify/vue';

const props = defineProps<{
  users: {
    id: string;
    name: string;
    email: string;
  }[]
}>();

const emit = defineEmits<{
  (event: 'update:user_id', value: string): void
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

const handleUserSelection = (user: { id: string; name: string; email: string; }) => {
  // console.log('before assignment', user.name); // Ensure this outputs the correct name
  // searchTerm.value = user.name;
  // console.log('after assignment', searchTerm.value); // C
  // showDropdown.value = false;
  // // emit('update:user_id', user);
  // // filteredUsers.value = [];
  // console.log('the search terms', searchTerm.value);
  // console.log('show the dropdown', showDropdown.value);
  // console.log(searchTerm.length >= 1 && showDropdown);
  selectedUser.value = user.name;
  searchTerm.value = '';
  emit('update:user_id', user);
}

const removeSelectedUser = () => {
  selectedUser.value = '';
  emit('update:user_id');
}
</script>

<template>
  <div class="relative flex items-center justify-between">
    <div class="relative w-1/2">
      <InputLabel for="existing-user" value="Search for user"/>
      <TextInput v-model="searchTerm" type="search" class="w-full"/>
      <ul v-if="searchUsers.length"
          class="absolute z-10 bg-white border border-gray-300 mt-1 rounded shadow-lg">
        <li v-for="user in searchUsers" :key="user.email" class="p-2 hover:bg-gray-200 cursor-pointer"
            @click="handleUserSelection(user)">
          {{ user.name }} ({{ user.email }})
        </li>
      </ul>
    </div>
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
  </div>
</template>

<style scoped>
/* Add styles if needed */
</style>
