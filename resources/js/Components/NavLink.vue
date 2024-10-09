<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<{
  href: string;
  active?: boolean;
}>();

const classes = computed(() =>
  props.active
    ?
    'inline-flex items-center px-1 pt-1 border-b-2 border-highlight text-sm font-medium leading-5 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out text-slate-600'
    :
    'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-slate-400 hover:text-slate-600 hover:border-highlight focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out',
);
</script>

<template>
  <Link :href="href" :class="classes">
    <slot />
  </Link>
</template>
