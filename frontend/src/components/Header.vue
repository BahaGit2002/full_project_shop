<script setup lang="ts">
import {ref} from 'vue';
import {useRoute} from 'vue-router';
import GroupIcon from "./icons/GroupIcon.vue";
import MenuIcon from './icons/MuneIcon.vue'
import SearchIcon from './icons/SearchIcon.vue'
import FavoriteIcon from './icons/FavoriteIcon.vue'
import OrderIcon from "./icons/OrderIcon.vue";
import CartIcon from "./icons/CartIcon.vue";
import DownIcon from "./icons/chevron/DownIcon.vue";

const getCookie = (name: string): string | null => {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop()?.split(';').shift() || null;
  return null;
};
const route = useRoute()

const isAuthenticated = ref(!!getCookie('auth_token'));
</script>

<template>
  <header
      class="w-full h-[72px] mx-auto flex items-center justify-between px-[232px] bg-white border-b border-gray-200">
    <!-- Логотип -->
    <router-link to="/" class="flex items-center space-x-2">
      <GroupIcon/>
      <span class="text-xl font-bold text-black">СЕВЕРЯНКА</span>
    </router-link>

    <div class="flex items-center space-x-5">
      <!--  Каталог  -->
      <button class="menu text-white px-5 py-2 rounded-md flex items-center space-x-2">
        <MenuIcon/>
        <span>Каталог</span>
      </button>

      <!--  Поиск  -->
      <div class="flex mx-4 relative">
        <input type="text" placeholder="Найти товар"
               class="flex-1 min-w-[250px] h-10 px-4 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-500"/>
        <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
          <SearchIcon/>
        </div>
      </div>
    </div>

    <!-- Иконки и профиль -->
    <div class="flex items-center space-x-8">
      <!-- Избранное -->
      <router-link
          to="/favorite"
          class="flex flex-col items-center text-sm"
          :class="{
            'text-red-500': route.path === '/favorite',
            'text-gray-600 hover:text-teal-500': route.path !== '/favorite'
          }"
      >
        <FavoriteIcon :is-filled="route.path === '/favorite'"/>
        Избранное
      </router-link>
      <!-- Заказы -->
      <button class="flex flex-col items-center text-gray-600 text-sm hover:text-teal-500">
        <OrderIcon/>
        Заказы
      </button>

      <!-- Корзина -->
      <button class="flex flex-col items-center text-gray-600 text-sm hover:text-teal-500">
        <CartIcon size="md"/>
        Корзина
      </button>

      <!--   Профиль   -->
      <div v-if="isAuthenticated" class="flex items-center space-x-4">
        <img src="@/assets/icons/avatar.png" alt="Avatar" class="w-8 h-8 rounded-full">
        <span class="text-gray-800">Алексей</span>
        <DownIcon/>
      </div>
      <router-link to="/sign-in" v-else class="flex flex-col items-center text-gray-600 text-sm hover:text-teal-500">
        <i class="fa fa-sign-in fa-2x" aria-hidden="true"></i>
        Sign In
      </router-link>

    </div>

  </header>

</template>

<style scoped>

</style>