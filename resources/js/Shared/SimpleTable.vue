<template>
  <div class="bg-white rounded-lg shadow p-5 mb-5">
    <slot name="header" />

    <table class="min-w-full">
      <!-- Table Header -->
      <thead>
        <tr>
          <th
            v-for="header in headers"
            :key="header.value"
            class="px-6 py-3 bg-gray-100 text-left text-xs leading-4 font-bold text-gray-500 uppercase tracking-wider"
          >{{header.text}}</th>
        </tr>
      </thead>

      <!-- Table Body -->
      <tbody class="bg-white divide-y divide-gray-200">
        <tr v-for="(item,index) in items" :key="index" class="hover:bg-gray-100">
          <td class="px-6" :class="dense ? '':'py-4'" v-for="header in headers" :key="header.value">
            <slot v-if="hasSlot(header.value)" :name="header.value" :item="item"></slot>

            <div v-else class="text-sm leading-5 text-gray-900">{{item[header.value]}}</div>
          </td>
        </tr>
        <tr>
          <slot name="footer" />
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    items: {
      type: Array,
      required: true,
    },
    headers: {
      type: Array,
      required: true,
    },
    dense: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    hasSlot(value) {
      return !!this.$scopedSlots[value];
    },
  },
};
</script>