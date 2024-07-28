<script setup>

import { defineProps } from 'vue';

defineProps({
  sidebarToggle: Function,
})


</script>

<template>
  <nav class="navbar navbar-light fixed-top">
    <div>
      <div class="sidebar-toggle nav-toggle mx-2">
        <button @click="sidebarToggle" class="navbar-toggler" type="button">
          <i class="bi bi-text-indent-left h2"></i></button>
      </div>
      <a href="" class="navbar-brand ms-lg-4 text-dark">
        <span class="text-danger font-bold">ABDUL </span> Web Tech
      </a>
    </div>

    <div class=" me-2 d-flex gap-1"><button class="btn btn-secondary btn-sm "
         aria-expanded="false">
        Logout
      </button> <img class="" src="../../../public/logo.jpg">
     
    </div>

  </nav>
</template>

<style>
nav {
  border-bottom: 2px solid gray;
  box-shadow: 1px 0.1rem 0.1rem white;
  display: flex;
  margin: 0;
  justify-content: space-between;
  background-color: var(--color-primary);

}
nav .sidebar-toggle {
  display: none;
}
nav img {
  height: 30px;
  width: 30px;
  border-radius: 50%;
}

</style>