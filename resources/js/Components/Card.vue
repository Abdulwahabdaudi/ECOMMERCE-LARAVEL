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

<style>
.card {
    margin-bottom: 1rem;
    border-radius: 0.4rem;
    font-weight: 500;
}

.card .card-header {
    text-align: center;

}

.card .card-body {
    padding-top: 0;
}

.card .card-body p {
    font-weight: 900;
    font-size: 2rem;
}
</style>