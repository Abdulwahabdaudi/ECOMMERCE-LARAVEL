<script setup>
import { Link } from '@inertiajs/vue3'
import { defineProps } from 'vue';

defineProps({
    sidebarToggle: Function,
    sidebarShow: Boolean,
})
</script>

<template>
    <aside :class="sidebarShow ? '' : 'hide'">
        <div class="sidebar-header">

            <div @click="sidebarToggle" class="sidebar-toggle"><i class="bi bi-text-indent-right"></i></div>
        </div>
        <div class="sidebar-body">
            <ul>
                <Link href="/admin/dashboard" :class="{ 'active': $page.url === '/admin/dashboard' }">
                <li>Dashboard</li>
                </Link>
                <Link :href="route('admin.pos')" :class="{ 'active': $page.url === '/admin/pos' }">
                <li>Pos</li>
                </Link>
                <Link :href="route('admin.product')" :class="{ 'active': $page.url.startsWith('/admin/product') }">
                <li>Product</li>
                </Link>
                <Link :href="route('admin.order')" :class="{ 'active': $page.url.startsWith('/admin/order') }">
                <li>Order</li>
                </Link>
                <Link :href="route('admin.customer')" :class="{ 'active': $page.url.startsWith('/admin/customer') }">
                <li>Customer</li>
                </Link>
                <!-- <Link :href="route('admin.report')" :class="{ 'active': $page.url.startsWith('/admin/report') }">
                <li>Report</li>
                </Link> -->
            </ul>
        </div>
    </aside>
</template>

<style >
/* ---------------SIDE BAR-------------------- */
aside {
  height: 100%;
  width: 12rem;
  background-color: var(--color-primary);
  position: fixed;

}
aside .sidebar-header {
  display: flex;
  justify-content: space-between;
  margin: 1rem 0.5rem 1rem 1rem;
}
aside .sidebar-toggle {
  display: none;
}
aside hr {
  border-bottom: 2px solid gray;
  box-shadow: 1px 0.1rem 0.1rem white;
  margin: 0;
  padding: 0;
  opacity: 1;
}
aside .sidebar-header p span {
  color: var(--c-blue);
}
aside .sidebar-header p {
  font-weight: bold;
  margin: 0 0 0 1rem;
}
aside ul {
  padding: 0;
}
aside ul a {
  display: flex;
  padding: 0.2rem 0.5rem;
  margin: 1rem 0 1rem 1rem;
  height: 2.5rem;
  align-items: center;
}
aside ul a.active {
  background-color: var(--color-background);
  border-radius: 2rem 0 0 2rem;
  color: var(--color-info-dark);
  position: relative;
}
aside ul a.active::before {
  content: '';
  width: 2.5rem;
  position: absolute;
  height: 2.5rem;
  border-radius: 0 0 1rem 0;
  background-color: transparent;
  right: 0;
  bottom: 2.5rem;
  box-shadow: 0.5rem 0.1rem 0 var(--color-background);
}
aside ul a.active::after {
  content: '';
  width: 2.5rem;
  position: absolute;
  height: 2.5rem;
  border-radius: 0 1rem 0 0;
  background-color: transparent;
  right: 0;
  top: 2.5rem;
  box-shadow: 0.5rem -0.1rem 0 var(--color-background);
}

aside a:hover {
  color: var(--color-white);
}


@media screen and (max-width: 760px) {
  .grids {
    grid-template-columns: 1fr;
  }
  main{
    margin-left: 2px;

  }
  aside {
    position: fixed;
    top: 0;
    z-index: 1;
    height: 100vh;
  }
  .hide {
    display: none;
  }
  .sidebar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .sidebar-header p {
    margin: auto 0;
  }
  aside .sidebar-toggle {
    display: inline;
  }

  aside ul a.active::before {
    display: none;
  }
  aside ul a.active::after {
    display: none;
  }

  aside .sidebar-toggle {
    cursor: pointer;
    margin: 0;
    padding: 0 3px;
  }
  aside .sidebar-toggle:hover {
    transform: scale(0.98);
    cursor: pointer;
    color: var(--c-blue);
    border-color: rgb(199, 199, 199);

  }

  nav .sidebar-toggle {
    display: inline;
  }
}

</style>