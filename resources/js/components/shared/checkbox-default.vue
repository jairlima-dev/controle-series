<template>

    <div class="ml-4 text-center text-xl">
        <label :for="id" class="block">{{ label }}</label>
        <input
            :id="id"
            type="checkbox"
            :checked="checked"
            @change="$emit('change', $event.target.checked)">
    </div>

</template>

<script>
    export default {
        name: "CheckboxDefault",

        model: {
            prop: 'checked',
            event: 'change'
        },

        props: ['checked', 'label', 'id']
        

    }
</script>