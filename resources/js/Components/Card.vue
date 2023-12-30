<script>

</script>

<template>
    <div class="card">
        <div class="card-header">
            <slot name="head"></slot>
        </div>
        <div class="card-body p-0 ">
            <slot name="body"></slot>
        </div>
        <div class="card-footer p-0">
            <slot name="footer"></slot>
        </div>
    </div>
</template>