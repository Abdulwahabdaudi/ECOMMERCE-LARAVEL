
<script>
export default {
    data() {
        return {
            date: new Date()
        }
    },
}
</script>
<template>
    <footer>
        <p>{{ date.getFullYear() }} BMC(Business Managing Center)</p>
        <p>Developed by ABDUL</p>
    </footer>
</template>