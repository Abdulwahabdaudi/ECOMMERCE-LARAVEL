<script>
import { Link } from '@inertiajs/vue3'
export default {

    props: [
        'sidebarToggle',
        'sidebarShow'],
    components: {
        Link,
    }
}

</script>



<template>
    <aside :class="sidebarShow ? '' : 'hide'">
        <div class="sidebar-header">
            
            <div @click="sidebarToggle" class="sidebar-toggle"><i class="bi bi-text-indent-right"></i></div>
        </div>
        <!-- <hr> -->
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
            </ul>
        </div>
    </aside>
</template>