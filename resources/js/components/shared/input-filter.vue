<template>

    <div class="flex items-center">

        <label for="filtro">Filtrar: </label>

        <input id="filtro"
               class="w-96 mx-2 p-2 border-2"
               type="search"
               :value="filter"
               @input="$emit('input', $event.target.value)">

    </div>

    <!--               @input="$emit('input', $event.target.value)"-->
    <!--               @input="filter = $event.target.value"-->

</template>

<script>

    import ButtonAction from "./button-action";
    export default {
        components: {ButtonAction},
        props: [
            'filter',
        ]
    }
</script>

<style scoped>

</style>
