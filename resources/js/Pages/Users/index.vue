<script setup>
import { watch } from "vue";
import { Link, useForm } from "@inertiajs/vue3";
import { EyeIcon, PencilSquareIcon } from "@heroicons/vue/24/solid";
import { createThrottledHandler } from '@/utils';

import DataTable from "@/Shared/DataTable.vue";
import SearchFilter from "@/Shared/SearchFilter.vue";
import SelectList from "@/Shared/SelectList.vue";
import Alert from "@/Shared/Alert.vue";
import AddNewBtn from "@/Components/AddNewBtn.vue";

const props = defineProps({
  users: Array | Object,
  filters: Object,
  success: String,
});

const headers = [
  { text: "ID", value: "id" },
  { text: "User Name", value: "name" },
  { text: "Email", value: "email" },
  { text: "Role", value: "role" },
  { text: "", value: "actions" },
];

const form = useForm({
  search: props.filters.search || "",
  count: props.filters.count || "15",
  page: props.filters.page || 1,
});


const throttledHandler = createThrottledHandler(form, 'users.index');
watch(() => form, throttledHandler, { deep: true });

function deleteUser(id) {
  if (confirm("Are You sure you want to delete this item ?")) {
    this.$inertia.delete("users/" + id);
  }
}
function reset() {
  props.form = {
    search: "",
    page: 1,
    count: "15",
  };
}
</script>

<template>
  <AppLayout title="Users">
    <!-- Success Messgage -->
    <Alert v-if="success" :message="success" />

      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="my-8 font-bold text-3xl capitalize">User List</h1>

        <div class="mb-3 flex justify-between items-center">
          <!--
              Filters
          -->
          <div class="flex max-w-md mr-4">
            <!-- Select Row Count -->
            <SelectList v-model="form.count" classes="rounded-l-md" />

            <!-- Search field -->
            <SearchFilter v-model="form.search" @reset="reset"></SearchFilter>
          </div>
          <!--
              Create Button
          -->
          <AddNewBtn :href="route('users.create')"/>
        </div>
        <!--
            Data Table
        -->
        <DataTable :items="users" :headers="headers" :filters="form">
          <template v-slot:actions="{ item }">
            <td class="flex justify-end text-sm leading-5 font-medium space-x-2">
              <a href="#" class="text-gray-600 hover:text-green-600">
                <EyeIcon class="w-6 h-6" />
              </a>

              <Link
                class="text-gray-600 hover:text-blue-600"
                :href="route('users.edit', item.id)"
                ><PencilSquareIcon class="w-6 h-6"
              /></Link>

              <!-- <delete-item :url="`sell_items/${item.id}`"></delete-item> -->
            </td>
          </template>
        </DataTable>
      </div>
  </AppLayout>
</template>
