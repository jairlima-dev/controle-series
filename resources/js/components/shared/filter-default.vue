<template>

<div class="flex items-center">

        <label for="filtro">Filtrar: </label>

        <input class="filtro w-96 border-2 ml-4 px-2 py-2 rounded-md"
               type="search" id="filtro"
               v-on:input="value = $event.target.value"
               placeholder="Digite aqui a sua busca">
        <button-action search="true"/>
<!--    -->
<!--        <input class="filtro w-96 border-2 ml-4 px-2 py-2 rounded-md" -->
<!--               type="search" id="filtro"-->
<!--               v-on:input="filter = $event.target.value"-->
<!--               placeholder="Digite aqui a sua busca">-->
<!--        <button-action search="true"/>-->

</div>


</template>

<script>

    import ButtonAction from "./button-action";
    export default {
        components: {ButtonAction},
        props: [
            'value'
        ]
    }
</script>

<style scoped>

</style>
