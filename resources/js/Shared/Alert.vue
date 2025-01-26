<template>
  <div
    v-show="show"
    class="
      mb-2
      max-w-5xl
      mx-auto
      bg-green-100 bg-opacity-50
      font-semibold
      text-green-700
      p-3
      rounded-xl
      relative
    "
    role="alert"
  >
    <div class="flex">
      <Icon
        icon="done"
        classes="mx-3 p-1 fill-current h-5 w-5 font-xl bg-green-400 rounded-2xl text-white"
      />
      <span class="block sm:inline">{{ message }}</span>
      <!-- <button class="block text-black" @click="success = false">cancel</button> -->
    </div>
  </div>
</template>

<script>

export default {
  props: {
    message: {
      type: String,
      default: "No Message",
    },
    type: {
      type: String,
      default: "success",
    },
  },
  data() {
    return {
      show: true,
    };
  },
  created() {
    setTimeout(() => {
      this.show = false;
    }, 3000);
  },
};
</script>

<style>
</style>