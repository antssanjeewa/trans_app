<script setup>
import { computed } from "vue";
import { useForm } from "@inertiajs/vue3";

import TextInput from "@/Shared/TextInput.vue";
import SelectInput from "@/Shared/SelectInput.vue";

const props = defineProps({
  user: Object,
  roles: Array,
  departments: Array,
  errors: Object,
});

const selectList = [
  { id: "0", name: "Inactive" },
  { id: "1", name: "Active" },
];

const form = useForm({
  name: props.user ? props.user.name : null,
  email: props.user ? props.user.email : null,
  role_id: props.user ? props.user.role_id : null,
  department_id: props.user ? props.user.department_id : null,
});

const btnText = computed(() => {
  return props.user ? "Update" : "Create";
});

const submit = () => {
  if (props.user) {
    form.put(route("users.update", props.user.id));
  } else {
    form.post(route("users.store"));
  }
};
</script>

<template>
  <app-layout title="Add User">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
      <h1 class="my-8 font-bold text-3xl">
        <Link class="text-blue-400 hover:text-blue-600" :href="route('users.index')"
          >Users</Link
        >
        <span class="text-indigo-400 font-medium">/</span>
        {{ btnText }}
      </h1>

      <div
        class="bg-white dark:bg-primary-700 dark:text-white rounded shadow overflow-hidden"
      >
        <form @submit.prevent="submit">
          <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
            <text-input
              v-model="form.name"
              :error="errors.name"
              class="pr-6 pb-8 w-1/2 flex-col"
              label="User Name"
            />

            <text-input
              v-model="form.email"
              :error="errors.email"
              class="pr-6 pb-8 w-1/2 flex-col"
              label="Email"
            />

            <text-input
              v-model="form.password"
              :error="errors.password"
              class="pr-6 pb-8 w-1/2 flex-col"
              type="password"
              label="Password"
            />

            <text-input
              v-model="form.password_confirm"
              :error="errors.password_confirm"
              class="pr-6 pb-8 w-1/2 flex-col"
              type="password"
              label="Comfirmed Password"
            />

            <SelectInput
                label="Role"
                v-model="form.role_id"
                :items="roles"
                :error="errors.name"
                class="pr-6 pb-8 w-1/2 flex-col"
            />

            <SelectInput
                label="Department"
                v-model="form.department_id"
                :items="departments"
                :error="errors.name"
                class="pr-6 pb-8 w-1/2 flex-col"
            />
          </div>
          <!-- Action Buttons -->
          <div
            class="px-4 py-4 bg-gray-100 dark:bg-primary-800 flex justify-end items-center"
          >
            <Link
              class="btn text-orange-600 hover:text-orange-800"
              :href="route('users.index')"
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
