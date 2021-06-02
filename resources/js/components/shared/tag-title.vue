<template>

    <div class="flex text-gray-600 text-2xl bg-gray-200 border-4
                border-gray-300 my-2 p-4 font-bold rounded-lg items-center
                justify-between">
        <slot></slot>
        <div>
            <button type="submit" @click.prevent="$router.go(-1)"
                    class="text-gray-500 font-bold
                     h-12 px-3 mr-2 rounded-md">
                <font-awesome-icon icon="undo-alt" size="lg"/>
                <p class="text-sm">Voltar</p>
            </button>
        </div>
    </div>

</template>

<script>

    import ButtonAction from "./button-action";

    export default {
        components: {ButtonAction},
        props: [
            'title',
            'subtitle'
        ]
    }

</script>
