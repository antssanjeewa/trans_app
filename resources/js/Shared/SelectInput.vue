<script setup>
// Define the props
const props = defineProps({
  modelValue: String | Number,
  dense: {
    type: Boolean,
    default: false
  },
  label: String,
  id: {
      type: String,
    },
    type: {
      type: String,
      default: "text",
    },
    items: Array,
    error: String,
});

// Define the emits
const emit = defineEmits(['update:modelValue']);

// Emit the update:modelValue event when input changes
const updateValue = (event) => {
  emit('update:modelValue', event.target.value);
};
</script>

<template>
  <div class="col-span-6 sm:col-span-3">
    <label
      :for="id"
      class="block text-sm font-medium leading-5 text-gray-700 dark:text-primary-100"
      >{{ label }}</label
    >
    <select
      :id="id"
      ref="input"
      :value="modelValue"
      @input="updateValue"
      :class="[error_border, size]"
      class="
        mt-1
        block
        w-full capitalize
        border border-gray-300 dark:border-primary-500 dark:focus:border-primary-500
        bg-white dark:bg-primary-600 dark:focus:bg-primary-500
        rounded-md
        shadow-sm
        focus:outline-none focus:shadow-outline-blue focus:border-blue-300
        transition
        duration-150
        ease-in-out
        sm:text-sm sm:leading-5
        focus:ring-0
      "
    >
      <option
        v-for="(item, index) in items"
        :key="index"
        class="capitalize"
        :value="itemValue(item)"
      >
        {{ itemText(item) }}
      </option>
    </select>
    <div v-if="error" class="text-red-700 mt-2 text-sm">{{ error }}</div>
  </div>
</template>

<script>
export default {
  computed: {
    size() {
      return this.dense ? "py-1 text-sm rounded" : "form-select";
    },
    error_border() {
      return this.error ? "border-red-600" : "";
    },
  },
  methods: {
    itemValue(item) {
      if (item.id) {
        return item.id;
      } else {
        return item;
      }
    },
    itemText(item) {
      if (item.name) {
        return item.name;
      } else {
        return item;
      }
    },

    focus() {
      this.$refs.input.focus();
    },
    select() {
      this.$refs.input.select();
    },
    setSelectionRange(start, end) {
      this.$refs.input.setSelectionRange(start, end);
    },
  },
};
</script>