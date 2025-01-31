<script setup>
import { computed, watch } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";
import { createThrottledHandler } from "@/utils";
import { TruckIcon, PlusIcon } from "@heroicons/vue/24/solid";

const props = defineProps({
  items: Array | Object,
  filters: Object,
  success: String,
});

const headers = [
  { text: "ID", value: "id" },
  { text: "Name", value: "name" },
  { text: "Status", value: "is_active" },
  { text: "", value: "actions" },
];

const form = useForm({
  search: props.filters.search || "",
  count: props.filters.count || "15",
  page: props.filters.page || 1,
});

const throttledHandler = createThrottledHandler(form, "users.index");
watch(() => form, throttledHandler, { deep: true });
</script>

<template>
  <AppLayout title="Vehicle">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="flex justify-end">
        <Link class="bg-blue-600 rounded-full p-2" :href="route('vehicles.create')">
          <PlusIcon class="w-5" />
        </Link>
      </div>
      <h1 class="mb-10 font-bold text-3xl text-center">Vehicle List</h1>

      <div class="flex flex-wrap justify-around">
        <div 
        v-for="item in items" :key="item.id" 
        class="text-center border p-3 rounded-xl dark:border-primary-700">
          <Link :href="route('vehicles.show', item.id)" >

          <img v-if="item.files[0]" :src="`/storage/${item.files[0]?.path}`" alt="image" width="150" >
          <TruckIcon v-else class="w-40" />

            <div class="dark:bg-primary-700">
              <div>{{ item.reg_number }}</div>
            </div>
          </Link>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
