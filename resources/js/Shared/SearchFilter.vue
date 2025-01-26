<script setup>
import { defineProps, defineEmits } from 'vue';

// Define the props
const props = defineProps({
  modelValue: {
    type: String,
    default: '',
  },
});

// Define the emits
const emit = defineEmits(['update:modelValue', 'reset']);

// Emit the update:modelValue event when input changes
const updateValue = (event) => {
  emit('update:modelValue', event.target.value);
};

// Handle reset
const reset = () => {
  emit('reset');  // Emit reset event to parent
};
</script>

<template>
  <!-- Search Field -->
  <div class="flex items-center">
    <div class="w-64 relative">
      <span class="absolute inset-y-0 left-0 flex items-center pl-2">
        <Icon icon="search" classes="h-4 w-4 fill-current text-primary-400" />
      </span>
      <input
        class="pl-8 rounded-l-none rounded form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 dark:bg-primary-700 dark:border-primary-600"
        autocomplete="off"
        type="text"
        name="search"
        placeholder="Search…"
        :value="modelValue" 
        @input="updateValue"
      />
    </div>

    <!-- Reset Button -->
    <button
      class="ml-3 text-sm text-primary-600 hover:text-primary-400 focus:text-black focus:outline-none"
      type="button"
      @click="$emit('reset')"
    >Reset</button>
  </div>
</template>