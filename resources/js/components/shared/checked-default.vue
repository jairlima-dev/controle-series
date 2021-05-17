<template>

    <div class="ml-4 text-center text-xl">

        <label class="block">{{ labelText }}</label>
        <input
            type="checkbox"
            :value="value"
            @input="$emit('input', $event.target.value)">

    </div>

</template>

<script>
    export default {
        name: "checked-default",

        props: {
            value: Boolean,
            labelText: String,

        }
    }
</script>
