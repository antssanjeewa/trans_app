<template>
  <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    <div class="flex flex-col">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
              <!-- Table Header -->
              <thead>
                <tr>
                  <th
                    v-for="header in headers"
                    :key="header.value"
                    class="px-4 py-3 bg-gray-100 text-left text-xs leading-4 font-bold text-gray-500 uppercase tracking-wider"
                  >{{header.text}}</th>
                </tr>
              </thead>

              <!-- Table Body -->
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="item in items.data" :key="item.id" class="hover:bg-gray-100">
                  <td class="px-4 py-2" v-for="header in headers" :key="header.value">
                    <slot v-if="hasSlot(header.value)" :name="header.value" :item="item"></slot>

                    <div v-else class="text-sm leading-5 text-gray-900 capitalize">{{ item[header.value]}}</div>
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

<script>
import Pagination from "@/Shared/Pagination";
export default {
  components: {
    Pagination,
  },
  props: {
    items: {
      type: Object,
    },
    headers: {
      type: Array,
    },
    filters: Object,
  },
  data: () => ({
    links: [],
  }),
  methods: {
    hasSlot(value) {
      return !!this.$scopedSlots[value];
    },
  },
};
</script>