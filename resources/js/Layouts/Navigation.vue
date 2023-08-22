<template>
  <nav class="navbar navbar-expand-lg navbar-light container px-2 justify-content-center mt-3" style="background-color:#E16416">
    <Link :href="route('dashboard')"><img src="@/assets/images/logo.png" class="logo-width"/></Link>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse ms-5" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <Link :href="route('dashboard')" class="nav-item nav-link active text-white">Dashboard</Link>
        </li>
        <li class="nav-item">
          <Link :href="route('logout')" method="post" class="nav-item nav-link text-white" as="button">Logout</Link>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
import NavLink from '@/Components/NavLink.vue'
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue'

export default {
  components: {
    NavLink,
    Link,
  },

  setup() {
    let showingTwoLevelMenu = ref(false)

    return {
      showingTwoLevelMenu
    }
  },
}
</script>
<style>
.logo-width{
  width: 150px;
}
</style>