<template>

    <div class="flex my-4 items-end">
        <slot></slot>
    </div>

</template>

<script>

    import ButtonLink from "./button-link";
    import FilterDefault from "../trash/input-filter"

    export default {

        props: [
            'to-link'
        ],

        components: {
            ButtonLink,
            FilterDefault,

        }


    }

</script>

<style scoped>

</style>
