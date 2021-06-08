<template>

    <div class="mx-1 block items-start">


        <ValidationProvider :rules="rules" :vid="vid" v-slot="{ errors }">
            <span class="block text-white bg-red-400 rounded-md px-2 my-1">{{ errors[0] }}</span>
            <label v-if="!errors[0]" :class="displayLabel" class="my-1">{{ labelText }}</label>
            <input
                :name="labelText"
                :type="type"
                :class="sizeField"
                :value="value"
                @input="$emit('input', $event.target.value)">
        </ValidationProvider>


    </div>

</template>

<script>

    import { extend } from "vee-validate";
    import { required, email, confirmed } from "vee-validate/dist/rules";

    extend('required', {
        ...required,
        message: 'O campo {_field_} é obrigatório'
    });

    extend('email', {
        ...email,
        message: 'Informe um e-mail válido'});

    extend('confirmed', confirmed);

    extend('min', {
        validate(value, args) {
            return value.length >= args.length;
        },
        params: ['length'],
        message: `O {_field_} precisa ter pelo menos {length} caracteres`
    });

    export default {

        props: {
            name: String,
            size: String,
            value: String,
            labelText: String,
            inputId: String,
            display: String,
            rules: String,
            vid: String,
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
