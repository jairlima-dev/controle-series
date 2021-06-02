<template>

    <router-link :to="{ name: to, params:  { id, numero, nome } }">

        <div :class="styleButton">
            <font-awesome-icon :icon="iClass"/>
            {{ tag }}
        </div>

    </router-link>

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
                if (this.type === 'add') return "plus-circle";
                if (this.type === 'link') return "external-link-alt";
                if (this.type === 'edit') return "pen";
                if (this.type === 'delete') return "trash-alt";
                if (this.type === 'save') return "check";
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

