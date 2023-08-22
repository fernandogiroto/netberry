<template>
    <Head title="Welcome" />
    <GuestLayout>
        <template #header>
            NETBERRY
          </template>
          <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Fernando Giroto</h5>
              <p class="card-text">info@fernandogiroto.com</p>
              <p class="card-text">+34 645442161</p>
              <p class="card-text"><a href="https://www.linkedin.com/in/fernandogiroto/" target="_blank">LINKEDIN</a></p>
              <p class="card-text"><a href="https://drive.google.com/file/d/1vtzz899OSs9SuvEFXuZuwVnr_mEHytYQ/view?usp=sharing" target="_blank">CURRICULUM</a></p>
              <p class="card-text"><a href="github.com/fernandogiroto" target="_blank">GITHUB</a></p>
              <p class="card-text"><a href="https://fernandogiroto.com" target="_blank">WEBSITE</a></p>
              <Link :href="route('register')" class="btn btn-primary me-2">Evaluate Dashboard</Link>
            </div>
          </div>
    </GuestLayout>
   
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>