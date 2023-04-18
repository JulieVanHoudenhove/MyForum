<script>
   export default {
       name: "com_section"
   }
</script>

<template>
    <section class="com">
        <h3>Commentaires</h3>
        <NewCom />
        <Com />
        <Com />
    </section>
</template>

<script setup>
    import Com from './Com.vue'
    import NewCom from './NewCom.vue'
</script>
<style></style>