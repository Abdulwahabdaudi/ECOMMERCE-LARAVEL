<script>
import Footer from '../components/Footer.vue';
import Navbar from '../components/Navbar.vue';
import Sidebar from '../components/Sidebar.vue';

export default {
    data() {
        return {
            sidebarShow: true
        };
    },
    methods: {
        sidebarToggle() {
            if (window.matchMedia("(max-width: 760px)").matches) {
                this.sidebarShow = !this.sidebarShow;
   
            }
        }
    },
    components: {
        Sidebar,
        Navbar,
        Footer
    }
}
</script>

<template>
   
        <div class="grids">
            <Sidebar :sidebarToggle="sidebarToggle" :sidebarShow="sidebarShow"/>
            <main>
                <Navbar :sidebarToggle="sidebarToggle"  />
                <div class="content">
                    <slot></slot>
                </div>
                <Footer/>
            </main>
        </div>
    
</template>

