<script setup>
import { Head } from '@inertiajs/vue3';
import Banner from '@/Components/Banner.vue';
import NavBar from './NavBar.vue';
import ProfileSetting from './ProfileSetting.vue';
import TeamSetting from './TeamSetting.vue';
import MobileNavBar from './MobileNavBar.vue';

defineProps({
    title: String,
});

</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />

        <div class="flex min-h-screen bg-primary-100 dark:bg-primary-900 dark:text-white">
            <!-- Primary Navigation Menu -->
            <NavBar />

            <div class="flex flex-col flex-grow">
                <header class="off">
                    <nav class="bg-white dark:bg-primary-800 border-b border-primary-100 dark:border-primary-700">
                        
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="flex justify-end h-16">
                                <div class="hidden sm:flex sm:items-center sm:ms-6">
                                    <TeamSetting v-if="$page.props.jetstream.hasTeamFeatures"/>

                                    <ProfileSetting/>
                                </div>

                                <!-- Moile -->
                                <MobileNavBar/>
                            </div>
                        </div>
                    </nav>
                </header>

                <!-- Main Content -->
                <main class="flex-grow p-6">
                    <slot />
                </main>
            </div>
        </div>

    </div>
</template>
