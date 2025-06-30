<script setup lang="ts">
import {ref} from 'vue';
import GoogleIcon from "../components/icons/social/GoogleIcon.vue";
import {login} from "../services/authService.ts";
import { useRouter } from 'vue-router';

const router = useRouter();
const email = ref('');
const password = ref('');
const showPassword = ref(false);
const errorMessage = ref<string | null>(null);
const successMessage = ref<string | null>(null);

const togglePassword = () => {
  showPassword.value = !showPassword.value;
};

const handleSubmit = async (event: Event) => {
  event.preventDefault();

  if (!email.value || !password.value) {
    errorMessage.value = 'Please fill in all fields';
    return;
  }

  const data = {
    email: email.value,
    password: password.value,
  };

  try {
    const response = await login(data);
    const token = response.data?.token;

    if (token) {
      document.cookie = `auth_token=${token}; max-age=${7 * 24 * 60 * 60}; Secure; SameSite=Strict`;
    }

    successMessage.value = 'Registration successful!';
    errorMessage.value = null;

    await router.push('/');

  } catch (error: any) {
    console.log(error);
    errorMessage.value = error.response?.data?.message || 'Registration failed. Please try again.';
    successMessage.value = null;
  }
};

</script>

<template>
  <div class="flex w-full">
    <div class="w-full md:w-1/2 p-20 space-y-10">
      <h1 class="text-4xl font-bold mb-4">Sign in</h1>
      <form @submit="handleSubmit">
        <div v-if="errorMessage" class="mb-4 text-red-600 text-sm text-center">
          {{ errorMessage }}
        </div>
        <div v-if="successMessage" class="mb-4 text-green-600 text-sm text-center">
          {{ successMessage }}
        </div>
        <input v-model="email" type="email" placeholder="Email" class="w-full p-3 mb-4 border rounded-lg"/>

        <div class="relative mb-4">
          <input
              v-model="password"
              :type="showPassword ? 'text' : 'password'"
              placeholder="Password"
              class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
          />
          <button
              type="button"
              class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700"
              @click="togglePassword"
          >
            <svg v-if="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m4.934.979A6 6 0 0112 9c1.657 0 3.155.672 4.242 1.758M3 3l18 18"></path>
            </svg>
            <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
            </svg>
          </button>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-lg mb-4">Sign in</button>
        <div class="text-center mb-4">or</div>
        <button
            type="button"
            class="w-full bg-white border border-gray-300 p-3 rounded-lg flex items-center justify-center"
        >
          Continue with Google
          <GoogleIcon/>
        </button>
        <p class="text-center text-sm text-gray-500 mt-4">
          Already have an account? <a href="/sign-up" class="text-blue-600">Sign up</a>
        </p>
      </form>
    </div>
    <div class="w-full md:w-1/2 hidden md:block">
      <img src="../assets/icons/right-column.png" alt="Background" class="w-full h-full object-cover"/>
    </div>
  </div>
</template>

<style scoped>

</style>