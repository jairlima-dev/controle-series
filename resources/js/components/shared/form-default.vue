<template>

    <form class="flex items-end" @submit.prevent="onSubmit($event)">
        <slot></slot>
    </form>

</template>

<script>
    export default {
        props: [],

        name: "form-default"
    }
</script>
