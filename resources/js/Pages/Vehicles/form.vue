<script setup>
import TextInput from "@/Shared/TextInput.vue";
import { computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import SelectInput from "@/Shared/SelectInput.vue";

const props = defineProps({
  item: Object,
  errors: Object,
})

const typeList = ['Bus','Van','Lorry'];

const form = useForm({
  reg_number: props.item ? props.item.reg_number : null,
  fuel_capacity: props.item ? props.item.fuel_capacity : null,
  type: props.item ? props.item.type : null,
})

const btnText = computed(() => {
  return props.item ? "Update" : "Create";
})

const submit = () => {
  if (props.item) {
    form.put(
      route('vehicles.update', props.item.id)
    );
  } else {
    form.post(route('vehicles.store'));
  }
}

</script>

<template>
  <app-layout title="Add Item">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
      <h1 class="my-8 font-bold text-3xl">
        <Link
            class="text-blue-400 hover:text-blue-600 capitalize"
            :href="route('vehicles.index')"
        >Vehicles</Link>
        <span class="text-indigo-400 font-medium px-2">/</span>
        {{ btnText }}
      </h1>

      <div class="bg-white dark:bg-primary-700 dark:text-white rounded shadow overflow-hidden">
        <form @submit.prevent="submit">
          <div class="p-8 flex flex-wrap">
            <TextInput
                v-model="form.reg_number"
                :error="errors.reg_number"
                class="pr-6 pb-6 w-full"
                label="Reg Number"
            />

            <TextInput
                v-model="form.fuel_capacity"
                :error="errors.fuel_capacity"
                class="pr-6 pb-6 w-full"
                label="Fuel Capacity"
            />

            <SelectInput
                label="Type"
                v-model="form.type"
                :items="typeList"
                :error="errors.type"
                class="pr-6 pb-6 w-full"
            />
          </div>

          <!-- Action Buttons -->
          <div class="px-4 py-4 bg-primary-100 dark:bg-primary-800 flex justify-end items-center">

            <Link
                class="btn text-orange-600 hover:text-orange-800"
                :href="route('vehicles.index')"
            >
            <span>Cancel</span>
            </Link>

            <button
                type="submit"
                :disabled="form.progress"
                class="bg-blue-900 hover:bg-blue-500 px-3 py-1 rounded ml-3"
            >
              <div
                  v-if="form.progress"
                  class="btn-spinner mr-2"
              />
              {{ btnText }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </app-layout>
</template>