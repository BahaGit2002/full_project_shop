<script setup lang="ts">
import { computed } from 'vue'

const props = defineProps<{
  size?: string;
  color?: string;
}>();

const sizeClasses = computed(() => {
  switch (props.size) {
    case 'sm':
      return 'w-4 h-4';
    case 'md':
      return 'w-6 h-6';
    case 'lg':
      return 'w-8 h-8';
    case 'xl':
      return 'w-10 h-10';
    case 'xxl':
      return 'w-12 h-12';
    default:
      return 'w-6 h-6';
  }
});

const fillColor = computed(() => props.color || '#414141');

</script>

<template>
  <svg :class="sizeClasses" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd"
          d="M6 21C6 19.6193 7.11929 18.5 8.5 18.5C9.88071 18.5 11 19.6193 11 21C11 22.3807 9.88071 23.5 8.5 23.5C7.11929 23.5 6 22.3807 6 21ZM8.5 19.5C7.67157 19.5 7 20.1716 7 21C7 21.8284 7.67157 22.5 8.5 22.5C9.32843 22.5 10 21.8284 10 21C10 20.1716 9.32843 19.5 8.5 19.5Z"
          :fill="fillColor"/>
    <path fill-rule="evenodd" clip-rule="evenodd"
          d="M18 21C18 19.6193 19.1193 18.5 20.5 18.5C21.8807 18.5 23 19.6193 23 21C23 22.3807 21.8807 23.5 20.5 23.5C19.1193 23.5 18 22.3807 18 21ZM20.5 19.5C19.6716 19.5 19 20.1716 19 21C19 21.8284 19.6716 22.5 20.5 22.5C21.3284 22.5 22 21.8284 22 21C22 20.1716 21.3284 19.5 20.5 19.5Z"
          :fill="fillColor"/>
    <path fill-rule="evenodd" clip-rule="evenodd"
          d="M1.5 0.5C1.22386 0.5 1 0.723858 1 1C1 1.27614 1.22386 1.5 1.5 1.5H5.08051C5.83783 5.79147 6.60333 10.0643 7.24931 14.3709C7.43288 15.5947 8.48416 16.5 9.72165 16.5H19.8597C21.0514 16.5 22.0774 15.6588 22.3111 14.4903L23.7503 7.29417C23.936 6.36599 23.226 5.5 22.2795 5.5H7.66046C7.3575 5.5 7.07797 5.58901 6.84436 5.74093L5.99239 0.913107C5.95023 0.674179 5.74262 0.5 5.5 0.5H1.5ZM7.166 7.07417C7.12065 6.77187 7.35478 6.5 7.66046 6.5H22.2795C22.595 6.5 22.8316 6.78866 22.7698 7.09806L21.3305 14.2942C21.1903 14.9953 20.5747 15.5 19.8597 15.5H9.72165C8.97916 15.5 8.34839 14.9568 8.23825 14.2225L7.166 7.07417Z"
          :fill="fillColor"/>
  </svg>
</template>