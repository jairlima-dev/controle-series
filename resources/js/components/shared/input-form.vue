<template>

    <div v-if="big" class="mx-1 block">

        <label class="block" :for="inputId">{{ labelText }} : {{ inputReturn }}</label>
        <label>
            <input type="text" :id="inputId" class="w-96 px-2 py-1 border-2 rounded-md"/>
        </label>

    </div>

</template>

<script>



    export default {

        props: {
            labelText: String,
            big: String,
            md: Boolean,
            sm: Boolean,
            inputId: String,
            inputName: String,
            inputValue: String,
        },

        data: function() {
            return {
                inputReturn: this.inputValue,
            }

        }
    }
</script>
