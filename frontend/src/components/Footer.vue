<script setup lang="ts">
import LogoIcon from "./icons/LogoIcon.vue";
import FacebookIcon from "./icons/social/FacebookIcon.vue";
import InstagramIcon from "./icons/social/InstagramIcon.vue";
import OkIcon from "./icons/social/OkIcon.vue";
import VKIcon from "./icons/social/VKIcon.vue";
import PhoneIcon from "./icons/social/PhoneIcon.vue";
</script>

<template>
  <footer
      class="footer w-full h-[126px] mx-auto flex items-center justify-between px-4 sm:px-8 lg:px-[232px] bg-[#f5e8d0] border-t border-gray-200 text-gray-600"
  >
    <div class="flex items-center space-x-8">
      <LogoIcon />
      <a href="#" class="text-sm hover:text-teal-500">О компании</a>
      <a href="#" class="text-sm hover:text-teal-500">Контакты</a>
      <a href="#" class="text-sm hover:text-teal-500">Вакансии</a>
      <a href="#" class="text-sm hover:text-teal-500">Статьи</a>
      <a href="#" class="text-sm hover:text-teal-500">Политика обработки персональных данных</a>
    </div>

    <div class="flex items-center space-x-8">
      <div class="flex items-center space-x-4">
        <InstagramIcon />
        <VKIcon />
        <FacebookIcon />
        <OkIcon />
      </div>

      <div class="flex items-center space-x-2">
        <PhoneIcon />
        <a href="tel:88007773333" class="text-base hover:text-teal-500">8 800 777 33 33</a>
      </div>
    </div>
  </footer>
</template>

<style scoped>
.footer {
  min-height: 126px; /* Maintain minimum height */
}
</style>