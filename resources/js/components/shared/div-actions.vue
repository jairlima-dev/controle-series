<template>

    <div class="flex my-4">
        <slot></slot>
    </div>

</template>

<script>

    import ButtonLink from "./button-link";
    import FilterDefault from "./filter-default"

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
