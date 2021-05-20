<template>

    <button @click.prevent="action"
        :class="styleButton" >
        <i :class="iClass"/>
        {{ tag }}
    </button>

</template>

<script>
    export default {

        props: [
            'type',
            'tag',
        ],

        methods: {
            action() {
                this.$emit('execute');
            },
        },

        computed: {

            iClass() {
                if (this.type === 'save') return 'fas fa-check';
                if (this.type === 'edit') return 'fas fa-pen';
                if (this.type === 'search') return 'fas fa-search';
                if (this.type === 'load') return 'fas fa-exchange-alt';
                if (this.type === 'link') return 'fas fa-external-link-alt';
                if (this.type === 'cancel') return 'fas fa-times';
            },

            styleButton() {
                if (this.type === 'save') {
                    return "border-4 border-blue-300 hover:border-blue-600 text-blue-400 " +
                        "font-bold text-xl h-12 py-2 px-3 mx-3 ring-current rounded-md"
                }
                if (this.type === 'edit') {
                    return "border-4 border-yellow-300 hover:border-yellow-600 text-yellow-400" +
                        " font-bold text-xl h-12 py-2 px-3 mr-2 rounded-md"
                }
                if (this.type === 'search') {
                    return "border-4 border-yellow-300 hover:border-yellow-600 text-yellow-400" +
                        " font-bold text-xl h-12 py-2 px-3 mr-2 rounded-md"
                }
                if (this.type === 'load') {
                    return "border-4 border-blue-300 hover:border-blue-600 text-blue-400 " +
                        "font-bold text-xl h-12 py-2 px-3 mx-3 ring-current rounded-md"
                }
                if (this.type === 'link') {
                    return "border-4 border-blue-300 hover:border-blue-600 text-blue-400 " +
                        "font-bold text-xl h-12 py-2 px-3 mx-3 ring-current rounded-md"
                }
                if (this.type === 'cancel') {
                    return "border-4 border-gray-300 hover:border-gray-600 text-gray-400 " +
                        "font-bold text-xl h-12 py-2 px-3 mr-2 rounded-md"
                }
            },

        },

    }
</script>
