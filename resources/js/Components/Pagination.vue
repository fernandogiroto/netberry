<template>
  <div v-if="links.length > 3">
    <ul class="pagination justify-content-center">
      <template v-for="(link, key) in links">
        <li class="page-item p-1" v-if="link.url === null" :key="key" v-html="link.label" />
        <li class="page-item p-1" :class="{ 'active': link.active }"  v-else :key="key + 1"><Link :href="link.url" v-html="link.label"></Link></li>
      </template>
    </ul>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  links: Array,
});
</script>