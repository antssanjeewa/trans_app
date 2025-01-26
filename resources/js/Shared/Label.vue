<template>
  <div class="bg-gray-300 rounded mb-3 self-center overflow-hidden">
    <div class="text-center pt-2">{{ title }}</div>
    <div
      v-for="item in items"
      :key="item.text"
      class="flex justify-between px-5 py-0.5"
      :class="item.style"
    >
      <div>{{ item.text }}</div>
      <b>{{ formatCurrency(item.value) }}</b>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      required: false,
    },
    items: {
      type: Array,
      required: true,
    },
  },
  methods: {
    formatCurrency(amount) {
      var val = parseFloat(amount);
      if (val) {
        return val.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
      } else {
        return "0.00";
      }
    },
  },
};
</script>

<style>
</style>