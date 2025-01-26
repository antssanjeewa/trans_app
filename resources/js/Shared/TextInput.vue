<template>
  <div class="col-span-6 sm:col-span-3">
    <label
      v-if="label"
      class="block text-sm font-medium leading-5 text-gray-700"
      :for="id"
      >{{ label }} <span v-if="required" class="text-red-500">*</span>:</label
    >
    <input
      :id="id"
      ref="input"
      v-bind="$attrs"
      :disabled="disabled"
      :placeholder="placeholder"
      class="
        mt-1
        flex flex-coll
        w-full
        transition
        duration-150
        ease-in-out
        sm:text-sm sm:leading-5
      "
      :class="[error_border, size]"
      :type="type"
      :value="value"
      @input="$emit('input', $event.target.value)"
      @keyup="$emit('keyup', $event)"
    />
    <div v-if="error_val" class="text-red-700 mt-2 text-sm">
      {{ error_val }}
    </div>
  </div>
</template>

<script>
export default {
  inheritAttrs: false,
  props: {
    id: {
      type: String,
      // default() {
      //   return `text-input-${this._uid}`;
      // },
    },
    type: {
      type: String,
      default: "text",
    },
    required: Boolean,
    dense: Boolean,
    value: [String, Number],
    label: String,
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
  },
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
      return this.dense ? "py-1 text-sm rounded" : "form-input";
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