<script setup>
import { router } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <!-- Settings Dropdown -->
    <div class="ms-3 relative">
        <Dropdown align="right" width="48">
            <template #trigger>
                <button v-if="$page.props.jetstream.managesProfilePhotos"
                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-primary-300 transition">
                    <img class="size-8 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                </button>

                <span v-else class="inline-flex rounded-md">
                    <button type="button"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-primary-500 dark:text-primary-400 bg-white dark:bg-primary-800 hover:text-primary-700 dark:hover:text-primary-300 focus:outline-none focus:bg-primary-50 dark:focus:bg-primary-700 active:bg-primary-50 dark:active:bg-primary-700 transition ease-in-out duration-150">
                        {{ $page.props.auth.user.name }}

                        <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                </span>
            </template>

            <template #content>
                <!-- Account Management -->
                <div class="block px-4 py-2 text-xs text-primary-400">
                    Manage Account
                </div>

                <DropdownLink :href="route('profile.show')">
                    Profile
                </DropdownLink>

                <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
                    API Tokens
                </DropdownLink>

                <div class="border-t border-primary-200 dark:border-primary-600" />

                <!-- Authentication -->
                <form @submit.prevent="logout">
                    <DropdownLink as="button">
                        Log Out
                    </DropdownLink>
                </form>
            </template>
        </Dropdown>
    </div>
</template>