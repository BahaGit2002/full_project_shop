<script setup lang="ts">
import RightIcon from "../components/icons/chevron/RightIcon.vue";
import StarRating from "../components/StarRating.vue";
import ShareIcon from "../components/icons/ShareIcon.vue";
import ReviewSection from '../components/ReviewSection.vue';
import FavoriteIcon from "../components/icons/FavoriteIcon.vue";
import SmileIcon from "../components/icons/feather-icon/SmileIcon.vue";
import CartIcon from "../components/icons/CartIcon.vue";
import BellOffIcon from "../components/icons/feather-icon/BellOffIcon.vue";
import FrameIcon from "../components/icons/FrameIcon.vue";
import ProductCard from "../components/ProductCard.vue";
import Image from '@/assets/img/img.png';
import {ref, onMounted} from "vue";
import {useRoute} from 'vue-router';
import {ProductDetail} from "../types/Product.ts";
import {getProductDetails} from "../services/productService.ts";

const route = useRoute();
const product = ref<ProductDetail | null>(null);

onMounted(async () => {
  const id = route.params.id;

  try {
    const res = await getProductDetails(id);
    product.value = res.data.data;
  } catch (error) {
    console.log(error);
  }
})

const products = [
  {id: 1, name: "Очень длинное название продукта 1 для акции", price: "44,50 Р", image: Image, rating: 4},
  {id: 2, name: "Продукт 2 с длинным названием для теста", price: "39,90 Р", image: Image, rating: 3},
  {id: 3, name: "Очень длинное название продукта 1 для акции", price: "50,50 Р", image: Image, rating: 4},
  {id: 4, name: "Продукт 2 с длинным названием для теста", price: "39,90 Р", image: Image, rating: 3},
];

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
];


</script>

<template>
  <div class="space-y-5">

    <!--  link  -->
    <div class="flex items-center space-x-5">
      <router-link to="/" class="text-base text-gray-500">Главная</router-link>
      <RightIcon/>
      <router-link to="/sale" class="text-base text-gray-500">Каталог</router-link>
      <RightIcon/>
      <router-link to="/sale" class="text-base text-gray-500">{{ product?.category?.name }}</router-link>
      <RightIcon/>
      <router-link :to="`/product/${product?.id}`" class="text-base text-gray-400">{{ product?.name }}</router-link>
    </div>

    <!--  title  -->
    <div class="title">
      <h1 class="text-2xl font-bold">{{ product?.name }}</h1>
    </div>

    <!-- review and share -->
    <div class="flex items-center gap-5">
      <span class="text-sm text-gray-500">арт. 371431</span>
      <div class="flex gap-2">
        <star-rating :rating="4"></star-rating>
        <span class="text-sm text-gray-500">3 отзыва</span>
      </div>
      <div class="flex items-center gap-2">
        <ShareIcon/>
        <router-link to="" class="text-sm text-gray-500 text-sm hover:text-teal-500">Поделиться</router-link>
      </div>
      <div class="flex items-center gap-2">
        <FavoriteIcon/>
        <button class="flex flex-col items-center text-gray-500 text-sm hover:text-teal-500">
          Избранное
        </button>
      </div>
    </div>

    <div class="flex md:flex-row gap-6">

      <div class="w-full md:w-1/2">
        <img :src="product?.image" alt="Product Image"
             class="w-full h-auto object-cover rounded-lg shadow-md"/>
      </div>

      <div class="w-full md:w-2/5 space-y-8 items-center">
        <!-- Prices -->
        <div v-if="product?.price?.has_discount" class="price-container justify-between">
          <div class="flex flex-col gap-5">
            <span class="text-3xl text-gray-500">{{ product?.price?.regular_price }} Р</span>
            <span class="text-sm text-gray-500">Обычная цена</span>
          </div>
          <div class="flex flex-col gap-4">
            <span class="text-4xl font-bold text-gray-800">{{ product?.price?.discount_price }} Р</span>
            <span class="text-sm text-gray-500">С картой Северяночки</span>
          </div>
        </div>
        <div v-else class="price-container justify-between">
          <div class="flex flex-col gap-4">
            <span class="text-4xl font-bold text-gray-800">108,99 Р</span>
          </div>
        </div>

        <div class="flex flex-col items-center space-y-3">
          <button
              class="w-full h-14 bg-[#FF6633] text-2xl text-white rounded-sm flex items-center px-4 hover:bg-[#E55A2C]"
          >
            <CartIcon size="xl" color="#FFFFFF"/>
            <span class="flex-1 text-center">В корзину</span>
          </button>
          <div class="flex gap-3">
            <SmileIcon/>
            <span class="text-green-500">Вы получаете 10 бонусов</span>
          </div>
          <div class="flex gap-3">
            <BellOffIcon/>
            <span class="text-gray-500">Уведомить о снижении цены</span>
          </div>
        </div>

        <!-- Product Info -->
        <div class="grid grid-cols-2 gap-4">
          <!-- Brand -->
          <div class="text-sm text-gray-600">Бренд</div>
          <div class="text-sm font-medium text-gray-800">{{ product?.brand }}</div>

          <!-- Country of Production -->
          <div class="text-sm text-gray-600">Страна производителя</div>
          <div class="text-sm font-medium text-gray-800">{{ product?.country }}</div>

          <!-- Packaging -->
          <div class="text-sm text-gray-600">Упаковка</div>
          <div class="text-sm font-medium text-gray-800">{{ product?.packaging }}</div>
        </div>

      </div>

      <div class="w-full md:w-1/5 space-y-6">

        <h2 class="text-base font-semibold text-gray-500">Похожие</h2>

        <div class="space-y-2">
          <div class="flex flex-col items-center">
            <img src="../assets/img/product/product1.png"
                 alt="Product"
                 class="w-24 h-16 object-cover rounded"
            >
          </div>
          <p class="text-xl font-medium text-gray-800 ml-4">157,50 ₽</p>
        </div>
        <div class="space-y-2">
          <div class="flex flex-col items-center">
            <img src="../assets/img/product/product1.png"
                 alt="Product"
                 class="w-24 h-16 object-cover rounded"
            >
          </div>
          <p class="text-xl font-medium text-gray-800 ml-4">157,50 ₽</p>
        </div>
        <div class="space-y-2">
          <div class="flex flex-col items-center">
            <img src="../assets/img/product/product1.png"
                 alt="Product"
                 class="w-24 h-16 object-cover rounded"
            >
          </div>
          <p class="text-xl font-medium text-gray-800 ml-4">157,50 ₽</p>
        </div>
        <div class="space-y-2">
          <div class="flex flex-col items-center">
            <img src="../assets/img/product/product1.png"
                 alt="Product"
                 class="w-24 h-16 object-cover rounded"
            >
          </div>
          <p class="text-xl font-medium text-gray-800 ml-4">157,50 ₽</p>
        </div>

      </div>

    </div>
  </div>

  <div class="product">
    <div class="flex items-center">
      <div class="flex justify-between w-full ">
        <h2 class="font-bold text-3xl">С этим товаров покупают</h2>
      </div>
    </div>
    <div class="card-container">
      <div class="flex overflow-x-auto space-x-14 pb-4 snap-x snap-mandatory">
        <ProductCard v-for="product in products" :key="product.id" :product="product">
          <FrameIcon/>
        </ProductCard>
      </div>
    </div>

  </div>

  <!-- Review -->
  <div>
    <ReviewSection/>
  </div>

  <div class="sale-product space-y-8">
    <div class="flex items-center">
      <div class="flex justify-between w-full">
        <h2 class="font-bold text-3xl">Акции</h2>
        <router-link to="/sale" class="flex space-x-8">
          <button class="text-gray-600">
            <router-link to="/sale">Все акции</router-link>
          </button>
          <div class="flex items-center">
            <RightIcon/>
          </div>
        </router-link>
      </div>
    </div>
    <div class="card-container">
      <div class="flex overflow-x-auto space-x-14 pb-4 snap-x snap-mandatory">
        <ProductCard v-for="product in promoProducts" :key="product.id" :product="product">
          <FrameIcon/>
        </ProductCard>
      </div>
    </div>
  </div>

</template>

<style scoped>
.price-container {
  display: flex;
  flex-direction: row;
}

@media (max-width: 768px) {
  .price-container {
    flex-direction: column;
  }
}
</style>