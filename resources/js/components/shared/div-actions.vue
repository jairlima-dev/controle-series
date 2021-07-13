<template>

    <div class="flex my-4 items-end">
        <slot></slot>
    </div>

</template>

<script>

    import ButtonLink from "./button-link";

    export default {
        name: "DivActions",

        props: [
            'to-link'
        ],

        components: {
            ButtonLink,
            FilterDefault,

        }


    }

</script>
