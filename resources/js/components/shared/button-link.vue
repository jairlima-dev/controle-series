<template>

<div>

    <router-link
        :to="{ name: to, params:  { id  } }">

        <div v-if="blue" class="bg-blue-500 hover:bg-blue-700
            text-white font-bold py-2 px-4 mr-2 rounded-md">
            {{ tag }}
            <slot></slot>
        </div>

        <div v-if="yellow" class="bg-yellow-500 hover:bg-yellow-700
            text-white font-bold py-2 px-4 mr-2 rounded-md">
            {{ tag }}
            <slot></slot>
        </div>

        <div v-if="red" class="bg-red-500 hover:bg-red-700
            text-white font-bold py-2 px-4 mr-2 rounded-md">
            {{ tag }}
            <slot></slot>
        </div>

    </router-link>


</div>



</template>

<script>
    export default {

        props: [
            'to',
            'id',
            'tag',
            'color',
            'blue',
            'red',
            'yellow'
        ]
    }
</script>

