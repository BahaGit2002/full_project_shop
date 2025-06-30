<script setup lang="ts">
import Header from './components/Header.vue'
import Footer from './components/Footer.vue';
</script>

<template>
  <div class="flex flex-col min-h-screen">
    <!-- Fixed Header -->
    <Header class="fixed top-0 left-0 right-0 z-10 bg-white shadow-md"/>

    <!-- Main content with adjusted padding -->
    <main class="flex-1 pt-16 pb-32">
      <div class="w-full px-4 sm:px-8 lg:px-[232px] mt-4 space-y-20">
        <router-view/>
      </div>
    </main>

    <!-- Footer at the bottom -->
    <Footer class="bg-[#f5e8d0] text-gray-700"/>
  </div>
</template>

<style scoped>
main {
  margin-top: 64px; /* Matches pt-16, adjust if Header height differs */
  padding-bottom: 126px; /* Explicitly match Footer height to ensure space */
}
</style>