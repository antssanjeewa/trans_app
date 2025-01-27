<script setup>
import { Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import NavLink from '@/Components/NavLink.vue';

import { userRoutes, adminRoutes } from '@/routes';
import { ref } from 'vue';

const appName = import.meta.env.VITE_APP_NAME || 'My App';

const isAdminPanelOpen = ref(true);
const toggleAdminRoutes = () => {
    isAdminPanelOpen.value = !isAdminPanelOpen.value;
};
</script>

<template>
    <aside class="w-64 bg-white dark:bg-primary-800 shadow-md flex flex-col">
        <div class="p-4 text-lg font-bold text-center">
            <!-- Logo -->
            <div class="shrink-0 flex items-center justify-center">
                <Link :href="route('dashboard')">
                <ApplicationMark class="block h-9 w-auto" />
                </Link>
                <div class="px-4">{{ appName }}</div>
            </div>
        </div>
        <nav class="flex-grow">
            <ul class="mt-4">
                <li v-for="routeItem in userRoutes" :key="routeItem.name">
                    <NavLink :href="routeItem.href" :active="route().current(routeItem.active)">
                        {{ routeItem.label }}
                    </NavLink>
                </li>

                <li>
                    <div class="border-b my-auto px-4 py-2 text-sm dark:border-primary-700 dark:bg-opacity-50 dark:bg-primary-900 cursor-pointer flex items-center justify-between"
                        @click="toggleAdminRoutes">
                        <span>Admin Panel</span>
                        <span :class="{ 'rotate-180': isAdminPanelOpen }" class="transition-transform">
                            <Icon icon="down_arrow" classes="fill-current h-4 w-4" />
                        </span>
                    </div>
                </li>


                <li v-if="isAdminPanelOpen" v-for="routeItem in adminRoutes" :key="routeItem.name">
                    <NavLink class="pl-[45px]" :href="routeItem.href" :active="route().current(routeItem.active)">
                        {{ routeItem.label }}
                    </NavLink>
                </li>

            </ul>
        </nav>
        <div class="p-4 border-t  dark:border-primary-700">
            <button class="w-full px-4 py-2 text-center text-white bg-red-900 rounded hover:bg-red-600">
                Logout
            </button>
        </div>
    </aside>
</template>