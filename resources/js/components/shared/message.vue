<template>

    <div
         class="alert red-600 p-2 mb-1 w-50 border-red-100-1 rounded-md bg-red-100 block">
        {{ text }}
        <ul>
            <li v-for="erro in errors">{{ erro }}</li>
        </ul>
        <slot></slot>
    </div>

</template>

<script>

    export default {
        props: [
            'text',
            'message'
        ]
    }
</script>

<style scoped>

</style>
