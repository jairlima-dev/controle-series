<template>

    <button @click.prevent="action"
        :class="styleButton">
        <font-awesome-icon :icon="iClass" />
        {{ tag }}
    </button>

</template>

<script>

    export default {

        props: {
            type: String,
            tag: String,
            confirmation: Boolean,
        },

        methods: {
            action() {
                if (this.confirmation) {
                    if (confirm("Confirma Operação?")) {
                        this.$emit('execute');
                    } else return;
                } else  {
                    this.$emit('execute');
                }

            },
        },

        computed: {
            iClass() {
                if (this.type === 'save') return 'check';
                if (this.type === 'edit') return 'pen';
                if (this.type === 'delete') return "trash-alt";
                if (this.type === 'search') return "search";
                if (this.type === 'load') return 'exchange-alt';
                if (this.type === 'link') return 'external-link-alt';
                if (this.type === 'cancel') return 'times';
                if (this.type === 'lock') return 'lock';
            },

            styleButton() {
                if (this.type === 'save') {
                    return "border-4 border-blue-300 hover:border-blue-600 text-blue-400 " +
                        "font-bold text-xl h-12 py-2 px-3 mr-2 ring-current rounded-md"
                }
                if (this.type === 'link') {
                    return "border-4 border-blue-300 hover:border-blue-600 text-blue-400 " +
                        "font-bold text-xl h-12 py-2 px-3 mr-2 ring-current rounded-md"
                }
                if (this.type === 'load') {
                    return "border-4 border-blue-300 hover:border-blue-600 text-blue-400 " +
                        "font-bold text-xl h-12 py-2 px-3 mr-2 ring-current rounded-md"
                }
                if (this.type === 'lock') {
                    return "border-4 border-blue-300 hover:border-blue-600 text-blue-400 " +
                        "font-bold text-xl h-12 py-2 px-3 mr-2 ring-current rounded-md"
                }
                if (this.type === 'delete') {
                    return "border-4 border-red-300 hover:border-red-600 text-red-400 " +
                        "font-bold text-xl h-12 py-2 px-3 mr-2 ring-current rounded-md"
                }
                if (this.type === 'cancel') {
                    return "border-4 border-gray-300 hover:border-gray-600 text-gray-400 " +
                        "font-bold text-xl h-12 py-2 px-3 mr-2 rounded-md"
                }
                if (this.type === 'edit' || 'search') {
                    return "border-4 border-yellow-300 hover:border-yellow-600 text-yellow-400" +
                        " font-bold text-xl h-12 py-2 px-3 mr-2 rounded-md"
                }

            },

        },
    }
</script>
