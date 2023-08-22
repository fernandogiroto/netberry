<template>
  <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
      <slot/>
    </div>
  </div>
</div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>
