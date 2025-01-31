<script setup>
import TextInput from "@/Shared/TextInput.vue";
import { computed } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import SelectInput from "@/Shared/SelectInput.vue";
import { ref } from "vue";
import { PencilIcon, TruckIcon } from "@heroicons/vue/24/solid";

const props = defineProps({
  item: Object,
  errors: Object,
});

const typeList = ["Bus", "Van", "Lorry"];

const form = useForm({
  reg_number: props.item ? props.item.reg_number : null,
  image: null,
  fuel_capacity: props.item ? props.item.fuel_capacity : null,
  type: props.item ? props.item.type : null,
  _method:  props.item ? 'put' : 'post'
});

const imagePreview = ref(null);

const handleFileChange = (event) => {
  const file = event.target.files[0]; // Get the selected file
  form.image = file;
  

  if (file) {
    // Use FileReader or URL.createObjectURL to create an image preview URL
    imagePreview.value = URL.createObjectURL(file);
  } else {
    imagePreview.value = null; // Clear preview if no file is selected
  }
};

const btnText = computed(() => {
  return props.item ? "Update" : "Create";
});

const submit = () => {
  if (props.item) {
    form.post(route("vehicles.update", props.item.id));
  } else {
    form.post(route("vehicles.store"));
  }
};
</script>

<template>
  <app-layout title="Add Item">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
      <h1 class="my-8 font-bold text-3xl">
        <Link
          class="text-blue-400 hover:text-blue-600 capitalize"
          :href="route('vehicles.index')"
          >Vehicles</Link
        >
        <span class="text-indigo-400 font-medium px-2">/</span>
        {{ btnText }}
      </h1>

      <div
        class="bg-white dark:bg-primary-700 dark:text-white rounded shadow overflow-hidden"
      >
        <form @submit.prevent="submit">
          <div class="p-8 flex flex-wrap">
            <div class="flex justify-center w-full">
              <div class="flex border rounded-full overflow-hidden dark:border-primary-600">
                <label
                  class="object-cover"
                  for="image"
                >
                
                  <img
                    v-if="imagePreview ?? item?.profile_image_url"
                    :src="imagePreview ?? item.profile_image_url"
                    alt="Vehicle Image Preview"
                    width="100"
                    height="100"
                    class="h-[100px]"
                  />

                  <TruckIcon v-else class="w-20 h-20" />
                </label>

                <input
                  id="image"
                  class="hidden"
                  type="file"
                  ref="image"
                  @change="handleFileChange"
                />
              </div>
            </div>

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
          <div
            class="px-4 py-4 bg-primary-100 dark:bg-primary-800 flex justify-end items-center"
          >
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
              <div v-if="form.progress" class="btn-spinner mr-2" />
              {{ btnText }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </app-layout>
</template>
