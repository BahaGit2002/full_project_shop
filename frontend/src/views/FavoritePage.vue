<script setup lang="ts">
import {onMounted, ref} from 'vue';

import RightIcon from "../components/icons/chevron/RightIcon.vue";
import ProductCard from "../components/ProductCard.vue";
import FrameIcon from "../components/icons/FrameIcon.vue";
import {Product} from "../types/Product.ts";
import { getFavorites } from "../services/favoriteService.ts";

const products = ref<Product[]>([]);

onMounted(async () => {
  try {
    products.value = await getFavorites();
  } catch (error) {
    console.error('Ошибка при загрузке данных:', error)
  }
})

const deleteFavorite = (productId: string) => {
  const product = products.value.find((p) => p.id === productId);
  if (product) {
    products.value = products.value.filter((p) => p.id !== productId);
  }
};

</script>

<template>
  <div class="space-y-8">

    <!-- link   -->
    <div class="flex items-center space-x-5">
      <router-link to="/" class="text-base text-gray-500">Главная</router-link>
      <RightIcon/>
      <router-link to="/favorite" class="text-base text-gray-400">Избранное</router-link>
    </div>

    <!--  title  -->
    <div class="title">
      <h1 class="text-5xl font-bold">Избранное</h1>
    </div>

    <!--  Product  -->
    <div class="grid grid-cols-4 gap-14">
      <ProductCard
          v-for="product in products"
          :key="product.id"
          :product="product"
          @click="deleteFavorite(product.id)"
      >
        <template #frame-icon>
          <FrameIcon :is-filled="product.is_favorited"/>
        </template>
      </ProductCard>
    </div>

  </div>
</template>

<style scoped>

</style>