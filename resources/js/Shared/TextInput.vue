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
  required: Boolean,

  error: String,
  autofocus: {
    type: Boolean,
    default: false,
  },
  disabled: {
    type: Boolean,
    default: false,
  },
  placeholder: {
    type: String,
  },
});

// Define the emits
const emit = defineEmits(['update:modelValue', 'keyup']);

// Emit the update:modelValue event when input changes
const updateValue = (event) => {
  emit('update:modelValue', event.target.value);
};
</script>
<template>
  <div v-bind="$attrs">
    <label
        v-if="label"
        class="block text-sm font-medium leading-5 text-primary-700 dark:text-primary-100"
        :for="id"
    >{{ label }} <span
          v-if="required"
          class="text-red-500"
      >*</span>:</label>

    <input
        :id="id"
        ref="input"
        :disabled="disabled"
        :placeholder="placeholder"
        class="
          block
          border-primary-300
          dark:border-primary-500
          focus:border-primary-300
          dark:focus:border-primary-500 
          focus:ring-0 
          mt-1 
          rounded-md
          shadow-sm 
          w-full
          dark:bg-primary-600 dark:focus:bg-primary-500
        "
        :class="[error_border, size]"
        :type="type"
        :value="modelValue"
        @input="updateValue"
        @keyup="$emit('keyup', $event)"
    />
    <div
        v-if="error_val"
        class="text-red-700 mt-2 text-sm"
    >
      {{ error_val }}
    </div>
  </div>
</template>

<script>
export default {
  inheritAttrs: false,

  data() {
    return {
      error_val: this.error,
    };
  },
  mounted() {
    this.autofocus && this.focus();
  },
  watch: {
    value(val) {
      if (val) {
        this.error_val = null;
      } else {
        this.error_val = this.error;
      }
    },
    error(val) {
      val && (this.error_val = val);
    },
  },
  computed: {
    size() {
      return this.dense ? "text-sm rounded" : "";
    },
    error_border() {
      return this.error_val ? "border-red-600" : "";
    },
  },
  methods: {
    focus() {
      this.$refs.input.focus();
    },
  },
};
</script>