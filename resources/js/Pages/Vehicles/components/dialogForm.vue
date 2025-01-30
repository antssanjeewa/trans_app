<script setup>
import SelectInput from "@/Shared/SelectInput.vue";
import TextInput from "@/Shared/TextInput.vue";
import { PlusIcon } from "@heroicons/vue/24/solid";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
  vehicle: Object,
  activeTab: String,
  errors: Object,
});

const showDialog = ref(false);

// Transport form
const transportForm = useForm({
  date: "",
  from: "",
  to: "",
  description: "",
  distance: "",
  user_id: "",
  driver_id: "",
  vehicle_id: props.vehicle.id,
});

// Expense form
const expenseForm = useForm({
  ref_number: "",
  date: "",
  amount: "",
  description: "",
  category: "fuel",
  vehicle_id: props.vehicle.id,
});

// Save transport details
const saveTransport = () => {
  transportForm.post("/transports", {
    preserveScroll: true,
    onSuccess: () => transportForm.reset(),
  });
};

// Save expense details
const submit = () => {
  expenseForm.post("/expenses", {
    preserveScroll: true,
    onSuccess: () => expenseForm.reset(),
  });
};
</script>

<template>
  <button
    @click="showDialog = true"
    class="flex bg-blue-900 text-xs px-3 my-1 items-center rounded"
  >
    <PlusIcon class="w-6 pr-2" /> Add New
  </button>

  <div
    v-if="showDialog"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center"
  >
    <div class="bg-white dark:bg-primary-800 p-6 rounded-lg w-1/3">
      <h2 class="text-lg font-bold mb-4">Add New Record</h2>

      <form @submit.prevent="submit">
        <!-- Transport Form -->
        <div v-if="activeTab === 'transports'">
          <div class="flex flex-wrap -mr-6 text-start">
            <TextInput
              v-model="transportForm.from"
              class="pr-6 pb-6 w-1/2"
              label="Start Location"
            />
            <TextInput
              v-model="transportForm.to"
              class="pr-6 pb-6 w-1/2"
              label="End Location"
            />
            <TextInput
              v-model="transportForm.date"
              class="pr-6 pb-6 w-1/2"
              type="date"
              label="Date"
            />
            <TextInput
              v-model="transportForm.distance"
              class="pr-6 pb-6 w-1/2"
              label="Distance"
            />

            <SelectInput label="Customer" class="pr-6 pb-6 w-full" />

            <SelectInput label="Driver" class="pr-6 pb-6 w-full" />

            <div class="pr-6 pb-6 w-full">
              <label class="text-sm">Other Details:</label>
              <textarea
                v-model="transportForm.description"
                class="w-full border rounded dark:bg-primary-600"
              ></textarea>
            </div>
          </div>
        </div>

        <!-- Expense Form -->
        <div v-if="activeTab === 'expenses'">
          <div class="flex flex-wrap -mr-6 text-start">
            <select v-model="expenseForm.category" class="w-full p-2 border rounded mb-2">
              <option value="fuel">Fuel</option>
              <option value="maintenance">Maintenance</option>
              <option value="repairs">Repairs</option>
              <option value="tolls">Tolls</option>
            </select>
            <input
              v-model="expenseForm.amount"
              type="number"
              placeholder="Amount"
              class="w-full p-2 border rounded mb-2"
            />
            <textarea
              v-model="expenseForm.description"
              placeholder="Description"
              class="w-full p-2 border rounded mb-2"
            ></textarea>
            <input
              v-model="expenseForm.date"
              type="date"
              placeholder="Date"
              class="w-full p-2 border rounded mb-2"
            />
          </div>
        </div>
          <!-- Action Buttons -->
          <div class="flex justify-end space-x-2">
            <button
              @click="showDialog = false"
              class="bg-gray-700 text-white px-4 py-2 rounded"
            >
              Cancel
            </button>

            <button
              type="submit"
              class="bg-blue-900 hover:bg-blue-500 px-4 py-2 rounded ml-3"
            >
              Save
            </button>
          
        </div>
      </form>
    </div>
  </div>
</template>
