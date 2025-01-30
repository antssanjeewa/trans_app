<script setup>
import { TruckIcon } from "@heroicons/vue/24/solid";

defineProps({
  vehicle: Object,
});
</script>

<template>
  <TruckIcon class="w-40 mx-auto" />
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
