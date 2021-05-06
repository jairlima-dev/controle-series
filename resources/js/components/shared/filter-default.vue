<template>

    <div>

        <label for="filtro">Filtrar: </label>
        <input class="filtro w-96 border-2 px-2 py-2 rounded-md" type="search" id="filtro"
               v-on:input="filter = $event.target.value"
               placeholder="Digite aqui a sua busca">

    </div>

</template>

<script>
    export default {
        props: [
        ]
    }
</script>

<style scoped>

</style>
