<template>

    <button @click.prevent="action"
            :class="styleButton">
        <font-awesome-icon :icon="iClass" />
        {{ tag }}
    </button>

</template>

<script>

    export default {
        name: "ButtonAction",

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
                if (this.type === 'lock') return 'lock';
                if (this.type === 'unlock') return 'unlock';
                if (this.type === 'cancel') return 'times';
                if (this.type === 'disabled') return 'times';
                if (this.type === 'logout') return 'sign-out-alt';
            },

            styleButton() {
                if (this.type === 'save' ||
                    this.type === 'link' ||
                    this.type === 'load' ||
                    this.type === 'unlock') {
                    return "border-4 border-blue-400 hover:border-blue-700 text-blue-500 " +
                        "font-bold text-xl h-12 py-2 px-3 mr-2 ring-current rounded-md"
                }
                if (this.type === 'lock' ||
                    this.type === 'disabled' ||
                    this.type === 'logout') {
                    return "focus:outline-none border-4 border-gray-300 hover:border-gray-300 text-gray-300 " +
                        "font-bold text-xl h-12 py-2 px-3 mr-2 ring-current rounded-md"
                }
                if (this.type === 'delete') {
                    return "border-4 border-red-400 hover:border-red-700 text-red-500 " +
                        "font-bold text-xl h-12 py-2 px-3 mr-2 ring-current rounded-md"
                }
                if (this.type === 'cancel') {
                    return "border-4 border-gray-400 hover:border-gray-700 text-gray-500 " +
                        "font-bold text-xl h-12 py-2 px-3 mr-2 rounded-md"
                }
                if (this.type === 'edit' ||
                    this.type === 'search') {
                    return "border-4 border-yellow-400 hover:border-yellow-700 text-yellow-500" +
                        " font-bold text-xl h-12 py-2 px-3 mr-2 rounded-md"
                }

            },

        },
    }
</script>
