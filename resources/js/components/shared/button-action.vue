<template>

    <div>

        <button v-if="save" type="submit"
                class="border-4 border-blue-300 hover:border-blue-600
            text-blue-400 font-bold text-xl h-12 py-1 px-2 mx-2 rounded-md" >
            <i v-if="save" class="fas fa-check"/>
            {{ saving ? 'Salvando...' : 'Salvar' }}
        </button>

        <div v-if="edit"
                class="border-4 border-yellow-300 hover:border-yellow-600
            text-yellow-400 font-bold text-xl h-12 pt-2 px-3 mr-2 rounded-md">
            <i v-if="edit" class="fas fa-pen"/>
            {{ tag }}
        </div>

    </div>

</template>

<script>
    export default {

        props: [
            'save',
            'edit',
            'back',
            'tag',
            // 'submit'
        ],

        data () {
            return {
                saving: false,
            }
        },


    }
</script>
