<template>

    <div class="mx-1 block items-center">

        <label :class="displayLabel">{{ labelText }}</label>
        <input
            :name="name"
            :type="type"
            :class="sizeField"
            :value="value"
            @input="$emit('input', $event.target.value)">

    </div>

</template>

<script>
    export default {

        props: {
            name: String,
            size: String,
            value: String,
            labelText: String,
            inputId: String,
            display: String,
            type: {
                type: String,
                default: 'text'
            },
        },

        computed: {
            sizeField() {
                if (this.size === 'lg') return "w-96 h-12 px-2 py-1 border-2 rounded-md";
                if (this.size === 'md') return "w-36 h-12 px-2 py-1 border-2 rounded-md";
                if (this.size === 'sm') return "w-24 h-12 px-2 py-1 border-2 rounded-md";
            },

            displayLabel() {
                if (!this.display) return 'block';
                if (this.display === 'inline') return 'inline-block'
            }
        },


    }

</script>
