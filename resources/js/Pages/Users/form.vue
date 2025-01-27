<template>
  <app-layout dept="3">
    <template #header>
      <h2 class="font-semibold text-gray-800 leading-tight">User List</h2>
    </template>
    <div class="pt-2">
      <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <h1 class="mb-8 font-bold text-3xl">
          <inertia-link class="text-blue-400 hover:text-blue-600" :href="route('users.index')">Users</inertia-link>
          <span class="text-indigo-400 font-medium">/</span>
          {{btnText}}
        </h1>
        <div class="bg-white rounded shadow overflow-hidden">
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

              <div v-for="role in roles" :key="role" class="flex-1 capitalize mx-5 mb-5">
                <radio-button v-model="form.role" :label="role" :val="role"></radio-button>
              </div>

              <text-input
                v-if="member"
                v-model="form.remark"
                :error="errors.remark"
                class="pr-6 pb-8 w-full flex-col"
                label="Remark Text"
              />
            </div>
            <!-- Action Buttons -->
            <div
              class="px-4 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center"
            >
              <inertia-link
                class="btn text-orange-500 hover:bg-gray-200"
                :href="route('users.index')"
              >
                <span>Cancel</span>
              </inertia-link>
              <button type="submit" :disabled="loading" class="btn btn-blue btn-shadow ml-3">
                <div v-if="loading" class="btn-spinner mr-2" />
                {{btnText}}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import TextInput from "@/Shared/TextInput";
import RadioButton from "@/Shared/RadioButton";
export default {
  components: {
    TextInput,
    RadioButton,
  },
  props: ["member", "roles", "errors"],
  // remember: "form",
  data() {
    return {
      sending: false,
      loading: false,
      form: {
        name: this.member ? this.member.name : null,
        email: this.member ? this.member.email : null,
        role: this.member ? this.member.role : null,
      },
    };
  },
  computed: {
    btnText() {
      return this.member ? "Update" : "Create";
    },
  },
  methods: {
    submit() {
      if (this.member) {
        this.$inertia.put(
          this.route("users.update", this.member.id),
          this.form,
          {
            onStart: () => (this.loading = true),
            onFinish: () => (this.loading = false),
          }
        );
      } else {
        this.$inertia.post(this.route("users.store"), this.form, {
          onStart: () => (this.loading = true),
          onFinish: () => (this.loading = false),
        });
      }
    },
  },
};
</script>