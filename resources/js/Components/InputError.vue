<template>
    <div v-show="message">
        <p class="invalid-feedback">
            {{ message }}
        </p>
    </div>
</template>

<script setup>
defineProps(['message']);
</script>
