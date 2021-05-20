<template>

    <div class="mx-1 block">

        <label class="block">{{ labelText }}</label>
        <input
            type="text"
            :class="sizeField"
            :value="value"
            @input="$emit('input', $event.target.value)">

    </div>

</template>

<script>
    export default {

        props: {
            size: String,
            value: String,
            labelText: String,
            // lg: String,
            // md: Boolean,
            // sm: Boolean,
            inputId: String,
        },

        computed: {
            sizeField() {
                if (this.size === 'lg') return "w-96 px-2 py-1 border-2 rounded-md";
                if (this.size === 'md') return "w-36 px-2 py-1 border-2 rounded-md";
                if (this.size === 'sm') return "w-24 px-2 py-1 border-2 rounded-md";
            },
        },


    }

</script>
