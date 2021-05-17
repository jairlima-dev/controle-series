<template>

    <div class="mx-1 block">
        <label class="block">{{ labelText }}</label>

            <input v-if="lg" class="w-96 px-2 py-1 border-2 rounded-md"
                   type="text"
                   :value="value"
                   @input="$emit('input', $event.target.value)">


            <input v-if="md" class="w-36 px-2 py-1 border-2 rounded-md"
                   type="text"
                   :value="value"
                   @input="$emit('input', $event.target.value)">


            <input v-if="sm" class="w-24 px-2 py-1 border-2 rounded-md"
                   type="text"
                   :value="value"
                   @input="$emit('input', $event.target.value)">


    </div>

</template>

<script>
    export default {

        props: {
            value: String,
            labelText: String,
            lg: String,
            md: Boolean,
            sm: Boolean,
            inputId: String,
        },

    }

</script>
