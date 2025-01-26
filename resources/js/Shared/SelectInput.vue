<template>
  <div class="col-span-6 sm:col-span-3">
    <label
      :for="id"
      class="block text-sm font-medium leading-5 text-gray-700"
      >{{ label }}</label
    >
    <select
      :id="id"
      ref="input"
      :value="value"
      @input="$emit('input', $event.target.value)"
      v-bind="$attrs"
      :class="[error_border, size]"
      class="
        mt-1
        block
        w-full
        py-2
        px-3
        border border-gray-300
        bg-white
        rounded-md
        shadow-sm
        focus:outline-none focus:shadow-outline-blue focus:border-blue-300
        transition
        duration-150
        ease-in-out
        sm:text-sm sm:leading-5
      "
    >
      <option
        v-for="(item, index) in items"
        :key="index"
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
  inheritAttrs: false,
  props: {
    id: {
      type: String,
      default() {
        return `text-input-${this._uid}`;
      },
    },
    type: {
      type: String,
      default: "text",
    },
    dense: Boolean,
    items: Array,
    value: [String, Number],
    label: String,
    error: String,
  },
  computed: {
    size() {
      return this.dense ? "py-1 text-sm rounded" : "form-select";
    },
    error_border() {
      return this.error_val ? "border-red-600" : "";
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