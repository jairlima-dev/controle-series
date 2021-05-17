<template>

    <div class="flex text-gray-600 text-2xl bg-gray-200 mb-2 p-4 font-bold rounded-md items-center justify-between">

        <div>
            <h1 class="">
                {{ title }}
            </h1>
        </div>

        <div>

            <button type="submit" @click.prevent="$router.go(-1)"
                    class="text-gray-500 font-bold
                     h-12 px-3 mr-2 rounded-md">
                <i class="fas fa-undo-alt text-3xl"/>
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
            'title'
        ]
    }

</script>
