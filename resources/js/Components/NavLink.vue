<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    var classNames = "flex items-center pl-5 h-12 border-b text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none border-indigo-400 dark:border-primary-700";
    classNames += props.active
        ? ' text-primary-900 dark:text-primary-100 focus:border-indigo-700 dark:bg-primary-700'
        : ' border-transparent text-primary-500 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 hover:border-primary-300 dark:hover:border-primary-700 focus:text-primary-700 dark:focus:text-primary-300 focus:border-primary-300 dark:focus:border-primary-700 dark:hover:bg-primary-700';

    return classNames;
});
</script>

<template>
    <Link :href="href" :class="classes">
    <slot />
    </Link>
</template>
