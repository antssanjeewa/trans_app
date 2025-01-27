<script setup>
import TextInput from "@/Shared/TextInput.vue";
import { computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import SelectInput from "@/Shared/SelectInput.vue";

const props = defineProps({
  title: String,
  item: Object,
  errors: Object,
})

const selectList = [
  { 'id': '0', 'name': 'Inactive' },
  { 'id': '1', 'name': 'Active' }
];

const form = useForm({
  name: props.item ? props.item.name : null,
  is_active: props.item ? props.item.is_active : '1',
})

const btnText = computed(() => {
  return props.item ? "Update" : "Create";
})

const submit = () => {
  if (props.item) {
    form.put(
      route(`${props.title}.update`, props.item.id)
    );
  } else {
    form.post(route(`${props.title}.store`));
  }
}

</script>

<template>
  <app-layout title="Add Item">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
      <h1 class="my-8 font-bold text-3xl">
        <Link
            class="text-blue-400 hover:text-blue-600 capitalize"
            :href="route(`${props.title}.index`)"
        >{{ title }}</Link>
        <span class="text-indigo-400 font-medium px-2">/</span>
        {{ btnText }}
      </h1>

      <div class="bg-white dark:bg-primary-700 dark:text-white rounded shadow overflow-hidden">
        <form @submit.prevent="submit">
          <div class="p-8 flex flex-wrap">
            <TextInput
                v-model="form.name"
                :error="errors.name"
                class="pr-6 w-4/5"
                label="Name"
            />

            <SelectInput
                label="Status"
                v-model="form.is_active"
                :items="selectList"
                :error="errors.name"
                class="w-1/5"
            />
          </div>

          <!-- Action Buttons -->
          <div class="px-4 py-4 bg-primary-100 dark:bg-primary-800 flex justify-end items-center">

            <Link
                class="btn text-orange-600 hover:text-orange-800"
                :href="route(`${props.title}.index`)"
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

          <progress
              v-if="form.progress"
              :value="form.progress.percentage"
              max="100"
          >
            {{ form.progress.percentage }}%
          </progress>
        </form>
      </div>
    </div>
  </app-layout>
</template>