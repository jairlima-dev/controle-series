<template>

    <ul class="flex flex-col" v-if="table">

        <li class="flex p-2 border-2 justify-between" v-for="{ nome } in table">

            <div class="title flex-1 p-2 text-xl">
                {{ nome }}
            </div>

            <slot></slot>

        </li>

    </ul>

</template>

<script>
    export default {

        props: [
            'table'
        ],

    }
</script>

<style scoped>

</style>
