<script setup lang="ts">
import { ref } from 'vue';
import {Product} from '../types/Product.ts'
import { addToFavorites, removeFromFavorites} from "../services/favoriteService.ts";

const props = defineProps<{
  product: Product
}>();

const emit = defineEmits<{
  (e: 'update:is_favorited', value: boolean): void;
}>();

const truncateText = (text: string, maxLength: number) => {
  if (text.length <= maxLength) return text;
  return text.slice(0, maxLength) + "...";
};

const isLoading = ref(false);

const toggleFavorite = async () => {
  if (isLoading.value) return;

  isLoading.value = true;
  try {
    if (props.product.is_favorited) {
      await removeFromFavorites(props.product.id);
      props.product.is_favorited = false
      emit('update:is_favorited', false);
    } else {
      await addToFavorites({ product_id: props.product.id });
      props.product.is_favorited = true
      emit('update:is_favorited', true);
    }
  } catch (error) {
    console.error('Failed to toggle favorite:', error);
  } finally {
    isLoading.value = false;
  }
};

</script>

<template>
  <div class="bg-white shadow-md rounded-lg overflow-hidden w-64 flex-shrink-0 snap-center flex flex-col h-full">
    <div class="relative w-full h-[150px] bg-gray-200 flex items-center justify-center">
      <img :src="product.image" alt="Image" class="w- h-[150px] object-cover rounded"/>
      <div class="absolute top-3 right-3 flex items-center">
        <button
            @click="toggleFavorite"
            class="cursor-pointer text-gray-800 hover:text-white"
            :disabled="isLoading"
        >
          <slot name="frame-icon" :is-filled="product.is_favorited" />
        </button>
      </div>
    </div>

    <div class="p-4 flex flex-col justify-between flex-grow h-full">
      <div class="flex flex-col flex-grow">
        <div>
          <div v-if="product.regular_price && product.discount_price" class="flex justify-between mt-2">
            <span class="text-xl font-bold">{{ product.regular_price }}</span>
            <span class="text-xl text-gray-600">{{ product.discount_price }}</span>
          </div>
          <div v-else class="flex justify-between mb-2">
            <span class="text-xl font-bold">{{ product.price }}</span>
          </div>

          <div v-if="product.regular_price && product.discount_price"
               class="flex justify-between mb-2 text-sm text-gray-300">
            <span>С картой</span>
            <span>Обычная</span>
          </div>

          <router-link :to="`/product/${product.id}`" class="text-lg mb-2">
            {{ truncateText(product.name, 40) }}
          </router-link>

          <div class="flex mt-2">
            <span
                v-for="star in 5"
                :key="star"
                :class="star <= product.rating ? 'text-yellow-400' : 'text-gray-300'"
            >
              ★
            </span>
          </div>
        </div>

        <button
            class="cart mt-auto bg-white px-4 py-2 rounded border border-green-500 hover:bg-green-700 w-full transition-colors duration-300"
        >
          В корзину
        </button>
      </div>
    </div>
  </div>
</template>
