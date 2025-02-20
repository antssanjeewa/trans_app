<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
import { TrashIcon, PencilIcon, ChevronLeftIcon } from "@heroicons/vue/24/solid";

import DialogForm from "./components/dialogForm.vue";
import DataTable from "./components/dataTable.vue";
import VehicleDetails from "./components/vehicleDetails.vue";

const props = defineProps({
  item: Object,
  transports: Object,
  expenses: Object,
  success: String,
});

// Tabs state
const activeTab = ref("transports");

const transportHeaders = [
  { text: "ID", value: "id" },
  { text: "Name", value: "reg_number" },
  { text: "", value: "actions" },
];

const expensesHeaders = [
  { text: "ID", value: "id" },
  { text: "Name", value: "reg_number" },
  { text: "Status", value: "is_active" },
  { text: "", value: "actions" },
];

</script>

<template>
  <AppLayout title="Vehicle">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 dark:text-primary-300">
      <!-- Header -->
      <div
        class="flex justify-between border rounded dark:border-primary-700 overflow-hidden"
      >
        <Link
          class="text-primary-400 border-r dark:border-primary-700 bg-primary-800 dark:hover:bg-primary-700 p-5"
          :href="route('vehicles.index')"
        >
          <ChevronLeftIcon class="w-5" />
        </Link>
        <h1 class="font-bold py-3 px-5 text-3xl text-center">{{ item.reg_number }}</h1>
        <div class="flex justify-end items-center">
          <Link
            class="text-blue-300 border-x dark:border-primary-700 bg-primary-800 dark:hover:bg-primary-700 p-5"
            :href="route('vehicles.create')"
          >
            <PencilIcon class="w-5" />
          </Link>
          <Link
            class="text-red-600 bg-primary-800 dark:hover:bg-primary-700 p-5"
            :href="route('vehicles.create')"
          >
            <TrashIcon class="w-5" />
          </Link>
        </div>
      </div>

      <div class="flex flex-wrap justify-between mt-8 gap-5">
        <!-- Left Section: Tabs for Latest Records -->
        <div class="text-center border p-3 rounded-xl dark:border-primary-800 w-3/4">
          <!-- Tabs for Transport and Expenses -->
          <div class="flex mb-4 justify-between">
            <div class="flex space-x-4">
              <button
                @click="activeTab = 'transports'"
                :class="{ 'border-b-2 border-primary-500': activeTab === 'transports' }"
                class="px-4 py-2 focus:outline-none"
              >
                Latest Transports
              </button>
              <button
                @click="activeTab = 'expenses'"
                :class="{ 'border-b-2 border-primary-500': activeTab === 'expenses' }"
                class="px-4 py-2 focus:outline-none"
              >
                Latest Expenses
              </button>
            </div>

            <!-- Add btn -->
            <DialogForm :activeTab="activeTab" :vehicle="item"/>
          </div>

          <!-- Latest Transports Table -->
          <div v-if="activeTab === 'transports'" class="overflow-x-auto">
            <DataTable :items="transports" :headers="transportHeaders" />
          </div>
          <div v-if="activeTab === 'expenses'" class="overflow-x-auto">
            <DataTable :items="expenses" :headers="expensesHeaders" />
          </div>
        </div>

        <!-- Right Section: Vehicle Details -->
        <div class="text-center border p-3 rounded-xl dark:border-primary-800 flex-grow">
          <VehicleDetails :vehicle="item" />
        </div>
      </div>
    </div>
  </AppLayout>
</template>
