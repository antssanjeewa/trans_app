<template>
  <div>
    <label class="inline-flex items-center">
      <input
        type="radio"
        ref="input"
        v-bind="$attrs"
        class="form-radio h-4 w-4 text-gray-600"
        :class="{ 'border-red-600': error }"
        :value="value"
        :checked="val == value"
        @input="$emit('input', val)"
      />
      <span class="ml-2 text-gray-700">{{ label }}</span>
    </label>
    <div v-if="error" class="text-red-700 mt-2 text-sm">{{ error }}</div>
  </div>
</template>

<script>
export default {
  inheritAttrs: false,
  props: {
    label: {
      required: true,
    },
    value: [String, Boolean],
    val: [String, Boolean],
    error: String,
  },
};
</script>

<style>
</style>