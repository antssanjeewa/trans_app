<script setup>
import { ChevronDoubleLeftIcon, ChevronDoubleRightIcon } from "@heroicons/vue/24/solid";

const props = defineProps({
  items: Object,
  headers: Array,
});

const emit = defineEmits(['loadData']);

</script>

<template>
  <div class="py-2 align-middle inline-block min-w-full">
    <table class="min-w-full overflow-hidden rounded-lg">
      <!-- Table Header -->
      <thead>
        <tr>
          <th
            v-for="header in headers"
            :key="header.value"
            class="px-4 py-3 bg-primary-100 dark:bg-primary-800 text-left text-xs leading-4 font-bold text-primary-500 uppercase tracking-wider"
          >
            {{ header.text }}
          </th>
        </tr>
      </thead>

      <!-- Table Body -->
      <tbody v-if="items" class="divide-y divide-primary-200 dark:divide-primary-800">
        <tr
          v-for="item in items.data"
          :key="item.id"
          class="hover:bg-primary-100 dark:hover:bg-primary-800"
        >
          <td class="px-4 py-2" v-for="header in headers" :key="header.value">
            <div class="text-sm text-left leading-5 capitalize">
              {{ item[header.value] }}
            </div>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Pagination Controls for Expenses -->
    <div v-if="items" class="flex text-xs justify-end items-center mt-4">
      <button
        @click="$emit('loadData',items.meta.current_page - 1)"
        :disabled="items.meta.current_page === 1"
        class="px-3 py-2 border border-primary-900 rounded"
        :class="items.meta.current_page != 1
          ? 'hover:border-primary-800 dark:text-primary-200'
          : 'dark:text-primary-600'"
      >
        <ChevronDoubleLeftIcon class="w-3" />
      </button>

      <span class="px-2"
        >Page {{ items.meta.current_page ?? "0" }} of
        {{ items.meta.last_page ?? "0" }}</span
      >

      <button
        @click="$emit('loadData',items.meta.current_page + 1)"
        :disabled="items.meta.current_page === items.meta.last_page"
        class="px-3 py-2 border border-primary-900 rounded "
        :class="items.meta.current_page != items.meta.last_page
          ? 'hover:border-primary-800 dark:text-primary-200'
          : 'dark:text-primary-600'"
      >
        <ChevronDoubleRightIcon class="w-3" />
      </button>
    </div>
  </div>
</template>
