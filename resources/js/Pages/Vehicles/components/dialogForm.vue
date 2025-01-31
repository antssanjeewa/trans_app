<script setup>
import SelectInput from "@/Shared/SelectInput.vue";
import TextInput from "@/Shared/TextInput.vue";
import { PlusIcon } from "@heroicons/vue/24/solid";
import { router, useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";

const props = defineProps({
  vehicle: Object,
  activeTab: String,
  users: Object,
  errors: Object,
});

const showDialog = ref(false);

watch(showDialog, (newValue, oldValue) => {
  if (newValue) {
    if (props.activeTab === "transports") {
      loadData("users");
    }
  } else {
    if (props.activeTab === "transports") {
      loadData("transports");
    }else{
      loadData("expenses");
    }
  }
});

const categoryList = ["fuel", "maintenance", "repairs", "tolls"];
// Transport form
const transportForm = useForm({
  date: new Date().toISOString().split("T")[0],
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
  date: new Date().toISOString().split("T")[0],
  amount: "",
  description: "",
  category: "fuel",
  vehicle_id: props.vehicle.id,
});

const loadData = (items) => {
  router.reload({ only: [items] });
};

// Save expense details
const submit = () => {
  if (props.activeTab === "transports") {
    transportForm.post("/transports", {
      preserveScroll: true,
      onSuccess: () => {
        transportForm.reset();
        showDialog.value = false;
      },
    });
  } else {
    expenseForm.post("/expenses", {
      preserveScroll: true,
      onSuccess: () => {
        expenseForm.reset();
        showDialog.value = false;
      },
    });
  }
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
              label="Distance (Km)"
            />

            <SelectInput v-model="transportForm.user_id" label="Customer" :items="users?.others ?? []" class="pr-6 pb-6 w-full" />

            <SelectInput v-model="transportForm.driver_id" label="Driver" :items="users?.drivers ?? []" class="pr-6 pb-6 w-full" />

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
            <TextInput
              v-model="expenseForm.ref_number"
              class="pr-6 pb-6 w-1/2"
              label="Ref Number"
            />

            <SelectInput
              v-model="expenseForm.category"
              :items="categoryList"
              label="Category"
              class="pr-6 pb-6 w-1/2"
            />

            <TextInput
              v-model="expenseForm.date"
              class="pr-6 pb-6 w-1/2"
              type="date"
              label="Date"
            />

            <TextInput
              v-model="expenseForm.amount"
              class="pr-6 pb-6 w-1/2"
              label="Amount"
            />

            <div class="pr-6 pb-6 w-full">
              <label class="text-sm">Other Details:</label>
              <textarea
                v-model="expenseForm.description"
                class="w-full border rounded dark:bg-primary-600"
              ></textarea>
            </div>
          </div>
        </div>
        <!-- Action Buttons -->
        <div class="flex justify-end space-x-2">
          <button
            @click="showDialog = false"
            type="button"
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
