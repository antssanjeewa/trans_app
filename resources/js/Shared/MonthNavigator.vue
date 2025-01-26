<template>
  <div class="flex text-base justify-between items-center border-b-2 border-t-2">
    <button @click="prev">{{"&lt;&lt; "+previousMonth}}</button>
    <div class="text-center text-black font-bold py-2 px-6 rounded-md">
      <div>{{year}}</div>
      <div class="text-2xl">{{months[current_month]}}</div>
    </div>
    <button @click="next">{{nextMonth+' >>'}}</button>
  </div>
</template>

<script>
export default {
  props: ["month"],
  data() {
    return {
      date: new Date().toISOString(),
      year: new Date().getFullYear(),
      current_month: new Date().getMonth(),
      months: [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
      ],
    };
  },
  created() {
    if (this.month) {
      var month;
      [this.year, month] = this.month.split("-");
      this.current_month = month - 1;
    }
  },
  computed: {
    nextMonth() {
      if (this.current_month == 11) {
        return this.months[0];
      } else {
        return this.months[this.current_month + 1];
      }
    },
    previousMonth() {
      if (this.current_month == 0) {
        return this.months[11];
      } else {
        return this.months[this.current_month - 1];
      }
    },
  },
  methods: {
    next() {
      if (this.current_month == 11) {
        this.year++;
        this.current_month = 0;
      } else {
        this.current_month++;
      }
      this.setReturnData();
    },
    prev() {
      if (this.current_month == 0) {
        this.year--;
        this.current_month = 11;
      } else {
        this.current_month--;
      }
      this.setReturnData();
    },
    setReturnData() {
      var month = this.current_month + 1;
      if (month < 10) {
        month = "0" + month;
      }
      this.$emit("loadData", this.year, month);
    },
  },
};
</script>

<style scoped>
button {
  @apply text-black bg-gray-300 py-2 px-4 rounded-md;
}
button:hover {
  @apply bg-gray-400;
}
button:focus {
  outline: none;
}
</style>