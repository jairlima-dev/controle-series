<template>

    <div class="ml-4 text-center text-xl">

        <label :for="id" class="block">{{ labelText }}</label>
        <input
            :id="id"
            type="checkbox"
            :checked="checked"
            @change="$emit('change', $event.target.checked)"
        hidden>
        <i v-if=" this.checked == 1" class="fas fa-check text-green-500 font-bold text-xl"/>
        <i v-if="this.checked == 0" class="fas fa-check text-gray-300 font-bold text-xl"/>

    </div>

</template>

<script>
    export default {

        model: {
            prop: 'checked',
            event: 'change'
        },

        props: {
            checked: String,
            labelText: String,
            id: Number,
        },

    }
</script>
