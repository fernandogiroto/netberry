<template>
  <main class="body flex-grow-1 px-3">
    <Navigation />
    <div class="container-lg">
      <h2 class="my-5 text-2xl font-semibold text-gray-700">
        <slot name="header" />
      </h2>
      <slot />
    </div>
  </main>
</template>

<script setup>
import Navigation from './Navigation.vue';
</script>
