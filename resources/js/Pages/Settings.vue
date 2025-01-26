<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
  <AppLayout title="Dashboard">
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-primary-800 overflow-hidden shadow-xl sm:rounded-lg p-3">

          <table class="w-full border-collapse">
            <thead>
              <tr>
                <th class="">State</th>
                <th class="">City</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="">Indiana</td>
                <td class="">Indianapolis</td>
              </tr>
              <tr>
                <td class="">Ohio</td>
                <td class="">Columbus</td>
              </tr>
              <tr>
                <td class="">Michigan</td>
                <td class="">Detroit</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
