<script>
export default {
    props: ['sidebarToggle'],
    computed: {
        routeName() {
            // return this.$route.name.toUpperCase()
        }
    }
}
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

        <div class="dropdown dropstart me-2 d-flex gap-1"><button 
            class="btn btn-secondary btn-sm dropdown-toggle  " 
            data-bs-toggle="dropdown" 
            aria-expanded="false">
            Admin 
        </button>             <img class="" src="../../../public/logo.jpg">

      <ul class="dropdown-menu dropdown-menu-dark text-white ">
        <li class="dropdown-item d-flex  p-0">
          <p class="m-auto">Logout <i class="bi bi-box-arrow-right"></i></p>     
        </li>
      </ul>
    </div>
        
        

    </nav>
</template>