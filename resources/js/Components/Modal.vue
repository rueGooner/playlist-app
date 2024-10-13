<script setup lang="ts">
import { computed, onMounted, onUnmounted, watch } from 'vue';
import { Icon } from '@iconify/vue';

const props = withDefaults(
  defineProps<{
    show?: boolean;
    maxWidth?: 'sm' | 'md' | 'lg' | 'xl' | '4xl';
    closeable?: boolean;
  }>(),
  {
    show: false,
    maxWidth: '4xl',
    closeable: true,
  },
);

const emit = defineEmits(['close']);

watch(
  () => props.show,
  () => {
    if (props.show) {
      document.body.style.overflow = 'hidden';
    } else {
      document.body.style.overflow = 'visible';
    }
  },
);

const close = () => {
  if (props.closeable) {
    emit('close');
  }
};

const closeOnEscape = (e: KeyboardEvent) => {
  if (e.key === 'Escape' && props.show) {
    close();
  }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));

onUnmounted(() => {
  document.removeEventListener('keydown', closeOnEscape);
  document.body.style.overflow = 'visible';
});

const maxWidthClass = computed(() => {
  return {
    sm: 'sm:max-w-sm',
    md: 'sm:max-w-md',
    lg: 'sm:max-w-lg',
    xl: 'sm:max-w-xl',
    '4xl': 'sm:max-w-4xl',
  }[props.maxWidth];
});
</script>

<template>
  <Teleport to="body">
    <Transition leave-active-class="duration-200">
      <div
        v-show="show"
        class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0 flex items-center justify-center"
        scroll-region
      >
        <Transition
          enter-active-class="ease-out duration-300"
          enter-from-class="opacity-0"
          enter-to-class="opacity-100"
          leave-active-class="ease-in duration-200"
          leave-from-class="opacity-100"
          leave-to-class="opacity-0"
        >
          <div
            v-show="show"
            class="fixed inset-0 transform transition-all"
            @click="close"
          >
            <div
              class="absolute inset-0 bg-gray-500 opacity-75 dark:bg-gray-900"
            />
            <div class="right-0 z-20 text-white opacity-100 relative">
              <Icon icon="mdi:close" class="text-7xl text-white z-20 right-0 top-10 cursor-pointer" @clic="close" />
            </div>
          </div>
        </Transition>

        <Transition
          enter-active-class="ease-out duration-300"
          enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          enter-to-class="opacity-100 translate-y-0 sm:scale-100"
          leave-active-class="ease-in duration-200"
          leave-from-class="opacity-100 translate-y-0 sm:scale-100"
          leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
          <div
            v-show="show"
            class="mb-6 transform overflow-hidden rounded-lg bg-white shadow-xl transition-all sm:mx-auto sm:w-full dark:bg-gray-800"
            :class="maxWidthClass"
          >
            <slot v-if="show" />
          </div>
        </Transition>
      </div>
    </Transition>
  </Teleport>
</template>
