<script setup>
defineProps({
  modelValue: {
    type: String,
    default: '',
  },
  classes:String,
})

const emit = defineEmits(['update:modelValue'])
</script>

<template>
  <div class="relative">
    <select :value="modelValue" @input="emit('update:modelValue', $event.target.value)" :class="classes"
      class="h-full rounded-none border-r-0 dark:border-primary-600 form-input block appearance-none bg-white dark:bg-primary-700 text-primary-500 dark:text-primary-200 py-2 px-4 pr-8 leading-tight focus:outline-none text-sm">
      <option value="5">5</option>
      <option value="15">15</option>
      <option value="25">25</option>
      <option value="50">50</option>
    </select>
    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-primary-700">
      <!-- <Icon icon="down_arrow" classes="fill-current h-4 w-4" /> -->
    </div>
  </div>
</template>