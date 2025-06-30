<script setup lang="ts">

import RightIcon from "../components/icons/chevron/RightIcon.vue";
import ProductCard from "../components/ProductCard.vue";
import FrameIcon from "../components/icons/FrameIcon.vue";
import Image from '@/assets/img/img.png';

const promoProducts = [
  {
    id: 1,
    name: "Очень длинное название продукта 1 для акции",
    newPrice: "44,50 Р",
    oldPrice: "50,50 Р",
    image: Image,
    rating: 4
  },
  {
    id: 2,
    name: "Продукт 2 с длинным названием для теста",
    newPrice: "39,90 Р",
    oldPrice: "45,00 Р",
    image: Image,
    rating: 3
  },
  {
    id: 3,
    name: "Очень длинное название продукта 1 для акции",
    newPrice: "44,50 Р",
    oldPrice: "50,50 Р",
    image: Image,
    rating: 4
  },
  {
    id: 4,
    name: "Продукт 2 с длинным названием для теста",
    newPrice: "39,90 Р",
    oldPrice: "45,00 Р",
    image: Image,
    rating: 3
  },
  {
    id: 5,
    name: "Продукт 2 с длинным названием для теста",
    newPrice: "39,90 Р",
    oldPrice: "45,00 Р",
    image: Image,
    rating: 3
  },
];

</script>

<template>
  <div class="space-y-8">

    <!-- link   -->
    <div class="flex items-center space-x-5">
      <router-link to="/" class="text-base text-gray-500">Главная</router-link>
      <RightIcon/>
      <router-link to="/sale" class="text-base text-gray-400">Акция</router-link>
    </div>

    <!--  title  -->
    <div class="title">
      <h1 class="text-5xl font-bold">Акция</h1>
    </div>

    <!--  Product  -->
    <div class="grid grid-cols-4 gap-14">
      <ProductCard v-for="product in promoProducts" :key="product.id" :product="product">
        <template #frame-icon>
          <FrameIcon/>
        </template>
      </ProductCard>
    </div>

  </div>
</template>

<style scoped>

</style>