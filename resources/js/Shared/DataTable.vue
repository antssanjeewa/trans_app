<script setup>
import Pagination from "@/Shared/Pagination.vue";
import { useSlots } from 'vue';

const props = defineProps({
  items:Object,
  headers:Array,
  filters: Object,
});

const slots = useSlots();
const hasSlot = (value) => {
  return !!slots[value];
};

</script>

<template>
  <div class="bg-white dark:bg-primary-900 overflow-hidden shadow-xl sm:rounded-lg">
    <div class="flex flex-col">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <div class="shadow overflow-hidden border-b border-primary-200 dark:border-primary-600 sm:rounded-lg">
            <table class="min-w-full divide-y divide-primary-200 dark:divide-primary-600">
              <!-- Table Header -->
              <thead>
                <tr>
                  <th
                    v-for="header in headers"
                    :key="header.value"
                    class="px-4 py-3 bg-primary-100 dark:bg-primary-700 text-left text-xs leading-4 font-bold text-primary-500 uppercase tracking-wider"
                  >{{header.text}}</th>
                </tr>
              </thead>

              <!-- Table Body -->
              <tbody class="bg-white dark:bg-primary-800 divide-y divide-primary-200 dark:divide-primary-600">
                <tr v-for="item in items.data" :key="item.id" class="hover:bg-primary-100 dark:hover:bg-primary-900">
                  <td class="px-4 py-2" v-for="header in headers" :key="header.value">
                    <slot v-if="hasSlot(header.value)" :name="header.value" :item="item"></slot>

                    <div v-else class="text-sm leading-5 text-primary-900 dark:text-white capitalize">{{ item[header.value]}}</div>
                  </td>
                </tr>
              </tbody>
            </table>

            <!-- Pagination Of Table -->
            <pagination :meta="items.meta" :links="items.links" :filters="filters" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>