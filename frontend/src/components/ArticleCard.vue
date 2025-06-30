<script setup lang="ts">
import { defineProps } from 'vue';

defineProps<{
  article: {
    id: number;
    date: string;
    title: string;
    description: string;
    image: string;
  };
}>();
</script>

<template>
  <div class="bg-white shadow-md rounded-lg overflow-hidden flex-1 flex flex-col min-h-0">
    <img :src="article.image" alt="Article image" class="w-full h-48 object-cover" />
    <div class="p-4 flex flex-col justify-between flex-grow">
      <div>
        <span class="text-sm text-gray-500">{{ article.date }}</span>
        <h3 class="font-bold text-xl mt-2 mb-3">{{ article.title }}</h3>
        <p class="text-gray-600 mb-4">{{ article.description }}</p>
      </div>
      <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 w-full mt-4">
        Подробнее
      </button>
    </div>
  </div>
</template>
