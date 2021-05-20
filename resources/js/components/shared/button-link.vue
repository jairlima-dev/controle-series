<template>

<div>

    <router-link :to="{ name: to, params:  { id, numero, nome } }">

        <div :class="styleButton">
            <i :class="iClass"/>
            {{ tag }}
        </div>

    </router-link>

</div>

</template>

<script>
    export default {

        props: [
            'type',
            'tag',
            'to',
            'id',
            'numero',
            'nome',
        ],

        computed: {

            iClass() {
                if (this.type === 'add') return "fas fa-plus-circle";
                if (this.type === 'link') return "fas fa-external-link-alt";
                if (this.type === 'edit') return "fas fa-pen";
                if (this.type === 'delete') return "fas fa-trash-alt";
                if (this.type === 'save') return "fas fa-check";
            },

            styleButton() {
                if (this.type === 'add') {
                    return "border-4 border-blue-300 hover:border-blue-600 " +
                        "text-blue-400 font-bold text-xl h-12 pt-2 px-3 mr-2 rounded-md"
                }
                if (this.type === 'link') {
                    return "border-4 border-blue-300 hover:border-blue-600 " +
                        "text-blue-400 font-bold text-xl h-12 pt-2 px-3 mr-2 rounded-md"
                }
                if (this.type === 'edit') {
                    return "border-4 border-yellow-300 hover:border-yellow-600 " +
                        "text-yellow-400 font-bold text-xl h-12 pt-2 px-3 mr-2 rounded-md"
                }
                if (this.type === 'delete') {
                    return "border-4 border-red-300 hover:border-red-600 " +
                        "text-red-400 font-bold text-xl h-12 pt-2 px-3 mr-2 rounded-md"
                }
                if (this.type === 'save') {
                    return "border-4 border-blue-300 hover:border-blue-600 " +
                        "text-blue-400 font-bold text-xl h-12 pt-2 px-3 mr-2 rounded-md"
                }
            },

        },
    }
</script>

