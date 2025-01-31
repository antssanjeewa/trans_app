<script setup>
import { TruckIcon } from "@heroicons/vue/24/solid";

defineProps({
  vehicle: Object,
});
</script>

<template>
  <img
    v-if="vehicle.files[0]"
    :src="`/storage/${vehicle.files[0]?.path}`"
    alt="image"
    class="mx-auto rounded"
    width="150"
  />
  <TruckIcon v-else class="w-40" />

  <div class="p-4 rounded flex text-sm justify-between">
    <div class="flex-grow space-y-1 text-left">
      <p>Model :</p>
      <p>Year :</p>
      <p>Capacity :</p>
      <p>Status :</p>
    </div>
    <div class="flex-grow space-y-1 text-right">
      <p>{{ vehicle.model ?? "-" }}</p>
      <p>{{ vehicle.type ?? "-" }}</p>
      <p>{{ vehicle.fuel_capacity ?? "-" }}</p>
      <p>{{ vehicle.description ?? "-" }}</p>
    </div>
  </div>
</template>
