<template>

    <div class="ml-4 text-center text-xl">

        <label :for="id" class="block">{{ labelText }}</label>
        <input
            :id="id"
            type="checkbox"
            :value="value"
            @input="$emit('input', $event.target.value)"
            hidden>
        <i v-if="this.value == 1" class="fas fa-check text-green-500 font-bold text-xl"/>
        <i v-if="this.value == 0" class="fas fa-check text-gray-300 font-bold text-xl"/>

    </div>

</template>

<script>
    export default {
        name: "checked-default",

        props: {
            value: String,
            labelText: String,
            id: Number,
            check: String,
            uncheck: String,

        },

    }
</script>
