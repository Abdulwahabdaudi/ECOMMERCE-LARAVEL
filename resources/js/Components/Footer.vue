
<script setup>

const date = new Date()
 
</script>
<template>
    <footer>
        <p>{{ date.getFullYear() }} BMC(Business Managing Center)</p>
        <p>Developed by ABDUL</p>
    </footer>
</template>


<style>
footer {
  display: flex;
  justify-content: space-between;
  font-weight: 600;
  width: 100%;
  border-top: 2px solid gray;
  margin-top: auto;
}
</style>