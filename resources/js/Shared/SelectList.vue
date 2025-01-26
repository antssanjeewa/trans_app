<template>
  <div class="relative">
    <select
      :value="value"
      @input="$emit('input', $event.target.value)"
      :class="classes"
      class="h-full rounded-none border-r-0 form-input block appearance-none bg-white text-gray-500 py-2 px-4 pr-8 leading-tight focus:outline-none"
    >
      <slot />
    </select>
    <div
      class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
    >
      <Icon icon="down_arrow" classes="fill-current h-4 w-4" />
    </div>
  </div>
</template>

<script>
export default {
  props: ["value", "classes"],
};
</script>

<style>
</style>