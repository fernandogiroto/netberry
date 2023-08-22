<template>
  <GuestLayout>
    <Head title="Log in"/>

    <div class="col-lg-6">
      <div class="card-group d-block d-md-flex row">
        <div class="card col-md-7 p-4 mb-0">
          <div class="card-body">
            <h1 class="mb-4 text-xl font-semibold text-gray-700">Login</h1>
            <form @submit.prevent="submit">
              <div class="mt-4">
                <InputLabel for="email" value="Email"/>
                <TextInput id="email" type="email" class="block w-full mt-1" v-model="form.email" required autofocus autocomplete="username" />
                <InputError class="mt-2" :message="form.errors.email" />
              </div>
  
              <div class="mt-4">
                <InputLabel for="password" value="Password"/>
                <TextInput id="password" type="password" class="block w-full mt-1" v-model="form.password" required autocomplete="current-password"/>
                <InputError class="mt-2" :message="form.errors.password" />
              </div>
  
              <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="ml-4">
                  Log in
                </PrimaryButton>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </GuestLayout>
</template>

<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
defineProps({
    canResetPassword: Boolean,
    status: String,
});
const form = useForm({
    email: '',
    password: '',
    remember: false
});
const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>
