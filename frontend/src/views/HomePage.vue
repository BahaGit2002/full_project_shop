<script setup lang="ts">
import {onMounted, ref} from 'vue';
import RightIcon from "../components/icons/chevron/RightIcon.vue";
import FrameIcon from "../components/icons/FrameIcon.vue";
import ProductCard from "../components/ProductCard.vue";
import ArticleCard from "../components/ArticleCard.vue";
import {Product} from "../types/Product.ts";
import { getProductsSale, getProducts } from "../services/productService.ts";
import Image1 from '@/assets/img/image5.png'
import Image2 from '@/assets/img/image6.png'
import Image3 from '@/assets/img/image7.png'

const productsSale = ref<Product[]>([]);
const products = ref<Product[]>([]);

const articles = [
  {
    id: 1,
    date: "05.03.2021",
    title: "Режим использования масок и перчаток на территории магазинов",
    description: "Подробная информация о режимах использования масок и перчаток на территории магазинов «Лента». Информация обновляется каждый будний день.",
    image: Image1
  },
  {
    id: 2,
    date: "05.03.2021",
    title: "Весеннее настроение для каждой",
    description: "8 Марта – это не просто Международный женский день, это ещё день Тюльпанов, приятных сюрпризов и праздничных тёплых пожеланий.",
    image: Image2
  },
  {
    id: 3,
    date: "22.02.2020",
    title: "ЗОЖ или Фастфуд, а вы на чьей стороне? Голосем!",
    description: "Голосуйте за любимые категории, выбирайте категорию-победителя в мобильном приложении и получайте кешбэк 10% баллами в апреле!",
    image: Image3
  },
];

onMounted(async () => {
  try {
    const response = await getProductsSale();
    productsSale.value = response.data.data;
  } catch (error) {
    console.error('Ошибка при загрузке данных:', error)
  }
})

onMounted(async () => {
  try {
    const response = await getProducts();
    products.value = response.data.data;
  } catch (error) {
    console.error('Ошибка при загрузке данных:', error)
  }
})

onMounted(() => {
  if (!window.ymaps) {
    const script = document.createElement('script');
    script.src = 'https://api-maps.yandex.ru/2.1/?lang=ru_RU';
    script.type = 'text/javascript';
    script.async = true;
    script.onload = () => {
      window.ymaps.ready(() => {
        const myMap = new window.ymaps.Map('map', {
          center: [61.6764, 50.8136],
          zoom: 10,
          controls: ['zoomControl', 'fullscreenControl']
        });
        const myPlacemark = new window.ymaps.Placemark([61.6764, 50.8136], {
          hintContent: 'Республика Коми',
          balloonContent: 'Республика Коми'
        }, {preset: 'islands#redDotIcon'});
        myMap.geoObjects.add(myPlacemark);
      });
    };
    document.head.appendChild(script);
  }
});

const updateFavoriteStatus = (productId: string, isFavorited: boolean) => {
  const product = products.value.find((p) => p.id === productId);
  const productSale = productsSale.value.find((p) => p.id === productId);
  if (product) {
    product.is_favorited = isFavorited;
  }
  if (productSale) {
    productSale.is_favorited = isFavorited;
  }
};

</script>

<template>
  <!-- Акции -->
  <div class="sale-product">
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
        <ProductCard
            v-for="product in productsSale"
            :key="product.id"
            :product="product"
            @update:is_favorited="updateFavoriteStatus(product.id, $event)"
        >
          <template #frame-icon>
            <FrameIcon :is-filled="!!product.is_favorited"/>
          </template>
        </ProductCard>
      </div>
    </div>
  </div>

  <!-- Новинки -->
  <div class="new-product">
    <div class="flex items-center">
      <div class="flex justify-between w-full">
        <h2 class="font-bold text-3xl">Новинки</h2>
        <router-link to="/new-items" class="flex space-x-8">
          <button class="text-gray-600">Все новинки</button>
          <div class="flex items-center">
            <RightIcon/>
          </div>
        </router-link>
      </div>
    </div>
    <div class="flex overflow-x-auto space-x-14 pb-4 snap-x snap-mandatory">
      <ProductCard
          v-for="product in products"
          :key="product.id"
          :product="product"
          @update:is_favorited="updateFavoriteStatus(product.id, $event)"
      >
        <template #frame-icon>
          <FrameIcon :is-filled="!!product.is_favorited"/>
        </template>
      </ProductCard>
    </div>
  </div>

  <!-- Покупали раньше -->
  <div class="purchased-before">
    <div class="flex items-center">
      <div class="flex justify-between w-full">
        <h2 class="font-bold text-3xl">Покупали раньше</h2>
        <div class="flex space-x-8">
          <button class="text-gray-600">Все покупки</button>
          <div class="flex items-center">
            <RightIcon/>
          </div>
        </div>
      </div>
    </div>
    <div class="card-container">
      <div class="flex overflow-x-auto space-x-14 pb-4 snap-x snap-mandatory">
        <ProductCard
            v-for="product in products"
            :key="product.id"
            :product="product"
            @update:is_favorited="updateFavoriteStatus(product.id, $event)"
        >
          <template #frame-icon>
            <FrameIcon :is-filled="!!product.is_favorited"/>
          </template>
        </ProductCard>
      </div>
    </div>
  </div>

  <!-- Специальные предложения -->
  <div class="special-offers">
    <div class="flex items-center mb-9">
      <h2 class="font-bold text-3xl">Специальные предложения</h2>
    </div>
    <div class="flex gap-8 justify-between">
      <div class="card flex items-start p-4 rounded-lg">
        <div class="text-left mr-4 w-1/2 min-h-[138px] flex flex-col justify-center">
          <span class="font-semibold text-2xl">Оформите карту «Северяночка»</span>
          <p class="text-base text-gray-600">И получайте бонусы при покупке в магазинах и на сайте</p>
        </div>
        <div class="w-1/2 min-h-[138px] flex items-center justify-center">
          <img src="@/assets/icons/card.png" alt="spec" width="206" height="138"/>
        </div>
      </div>
      <div class="basket flex items-start p-4 rounded-lg">
        <div class="text-left mr-4 w-1/2 min-h-[138px] flex flex-col justify-center">
          <span class="font-semibold text-2xl">Покупайте акционные товары</span>
          <p class="text-base text-gray-600">И получайте вдвое больше бонусов</p>
        </div>
        <div class="w-1/2 min-h-[138px] flex items-center justify-center">
          <img src="@/assets/icons/basket.png" alt="spec" width="206" height="138"/>
        </div>
      </div>
    </div>
  </div>

  <!-- Раздел "Наши магазины" -->
  <div class="stores-section">
    <div class="flex items-center mb-4">
      <h2 class="font-bold text-3xl">Наши магазины</h2>
    </div>
    <div id="map" class="w-full h-[400px] rounded-lg"></div>
  </div>

  <!-- Раздел "Статьи" -->
  <div class="articles-section">
    <div class="flex items-center mb-8">
      <h2 class="font-bold text-3xl">Статьи</h2>
    </div>
    <div class="flex flex-col md:flex-row gap-8">
      <ArticleCard v-for="article in articles" :key="article.id" :article="article"/>
    </div>
  </div>
</template>

<style scoped>

.sale-product > div:nth-child(2),
.new-product > div:nth-child(2),
.purchased-before > div:nth-child(2) {
  padding-top: 2rem;
  padding-bottom: 2rem;
}

.basket {
  background-color: #E5FFDE;
}

.card {
  background-color: #FCD5BA;
}
</style>