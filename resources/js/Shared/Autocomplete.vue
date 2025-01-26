<template>
  <div class="relative">
    <div class="col-span-6 sm:col-span-3">
      <label
        v-if="label"
        class="block text-sm font-medium leading-5 text-gray-700"
        :for="id"
        >{{ label }}:</label
      >
      <input
        :id="id"
        ref="autocomplete"
        :value="input_value"
        type="search"
        class="
          mt-1
          form-input
          block
          w-full
          transition
          duration-150
          ease-in-out
          sm:text-sm sm:leading-5
        "
        :class="{ 'border-red-600': error }"
        @input="$emit('input', $event.target.value)"
        @keyup="$emit('keyup', $event.target.value)"
        @focus="setDropDown"
        @keydown.down="onArrowDown"
        @keydown.up="onArrowUp"
        @keydown.enter="onEnter"
      />
      <div v-if="error" class="text-red-700 mt-2 text-sm">{{ error }}</div>
    </div>
    <!-- Full Screen Dropdown Overlay -->
    <div
      v-show="input_value && open"
      class="fixed inset-0 z-10"
      @click="clickOuter"
    ></div>
    <div
      v-if="input_value && open"
      class="z-10 w-full max-h-52 absolute bg-white border-2 overflow-y-scroll"
    >
      <div v-if="items && items.length < 1" class="px-5 py-2">No Data</div>
      <button
        v-for="(item, index) in items"
        :key="item.id"
        class="
          px-5
          py-2
          text-left
          w-full
          block
          hover:bg-gray-300
          focus:outline-none
        "
        :class="{ 'is-active': index === arrowCounter }"
        @click="selectItem(item)"
      >
        {{ item[item_text] }}
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    id: {
      type: String,
      default() {
        return `text-input-${this._uid}`;
      },
    },
    type: {
      type: String,
      default: "text",
    },
    items: Array,
    item_text: {
      type: String,
      default: "name",
    },
    item_value: {
      type: String,
      default: "id",
    },
    return_object: {
      type: Boolean,
      default: false,
    },
    value: [String, Number, Object],
    label: String,
    error: String,
    autofocus: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      open: true,
      input_value: null,
      arrowCounter: 0,
    };
  },
  created() {
    if (this.value) {
      this.open = false;
      this.input_value = this.value;
    }
  },
  watch: {
    value(val) {
      if (this.open) this.input_value = val;
    },
  },
  methods: {
    clickOuter() {
      this.open = false;
      this.$emit("input", "");
      this.input_value = null;
    },
    selectItem(item) {
      if (this.return_object) {
        this.$emit("input", item);
      } else {
        this.$emit("input", item[this.item_value]);
      }
      this.input_value = item[this.item_text];
      this.open = false;
    },
    setDropDown() {
      this.open = true;
      this.input_value = " ";
    },
    onArrowDown() {
      if (this.arrowCounter + 1 < this.items.length) {
        this.arrowCounter += 1;
      }
    },
    onArrowUp() {
      if (this.arrowCounter > 0) {
        this.arrowCounter -= 1;
      }
    },
    onEnter() {
      this.selectItem(this.items[this.arrowCounter]);
      this.arrowCounter = 0;
    },
  },
};
</script>

<style>
.is-active {
  background-color: #262727;
  color: white;
}
</style>