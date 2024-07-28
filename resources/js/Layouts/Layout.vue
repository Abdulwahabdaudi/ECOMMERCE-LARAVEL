<script setup>
import { ref } from 'vue';
import Footer from '@/Components/Footer.vue';
import Navbar from '@/Components/Navbar.vue';
import Sidebar from '@/Components/Sidebar.vue';

const sidebarShow = ref(true)

const sidebarToggle = () => {
    if (window.matchMedia("(max-width: 760px)").matches) {
        sidebarShow.value = !sidebarShow.value;

    }
}

</script>

<template>

    <div class="gridsl">
        <Sidebar :sidebarToggle="sidebarToggle" :sidebarShow="sidebarShow" />
        <main>
            <Navbar :sidebarToggle="sidebarToggle" />
            <div class="content">
                <slot></slot>
            </div>
            <Footer />
        </main>
    </div>

</template>

<style>
/* ----------MAIN -------------------- */
main {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  margin-left: 12.5rem;
}
grids {
  display: grid;
  grid-template-columns: 13rem auto;
  gap: 0.5rem;
}

.content {
  margin: 1rem;
}
</style>
