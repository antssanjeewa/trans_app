<template>
  <!-- Search Field -->
  <div class="flex items-center">
    <div class="w-64 relative">
      <span class="absolute inset-y-0 left-0 flex items-center pl-2">
        <Icon icon="search" classes="h-4 w-4 fill-current text-gray-400" />
      </span>
      <input
        class="pl-8 rounded-l-none form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
        autocomplete="off"
        type="text"
        name="search"
        placeholder="Search…"
        :value="value"
        @input="$emit('input', $event.target.value)"
      />
    </div>

    <!-- Reset Button -->
    <button
      class="ml-3 text-sm text-gray-600 hover:text-gray-400 focus:text-black focus:outline-none"
      type="button"
      @click="$emit('reset')"
    >Reset</button>
  </div>
</template>

<script>
export default {
  props: {
    value: String,
    maxWidth: {
      type: Number,
      default: 300,
    },
  },
};
</script>