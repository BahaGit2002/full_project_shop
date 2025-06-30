<script setup lang="ts">

defineProps({
  rating: {
    type: Number,
    default: 0,
  },
  maxStars: {
    type: Number,
    default: 5,
  },
});
</script>

<template>
  <div class="flex">
    <span
        v-for="star in maxStars"
        :key="star"
        :class="{
        'cursor-pointer text-yellow-400': star <= rating,
        'text-gray-300': star > rating
      }"
    >
      <i class="fas fa-star"></i>
    </span>
  </div>
</template>

<style scoped>
</style>