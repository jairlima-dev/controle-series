<template>

    <div>

        <button v-if="save" type="submit"
                class="border-4 border-blue-300 hover:border-blue-600
            text-blue-400 font-bold text-xl h-12 py-2 px-3 mx-3 rounded-md" >
            <i v-if="save" class="fas fa-check"/>
            {{ tag }}
<!--            {{ saving ? 'Salvando...' : 'Salvar' }}-->
        </button>

        <button v-if="edit" type="submit"
                class="border-4 border-yellow-300 hover:border-yellow-600
            text-yellow-400 font-bold text-xl h-12 py-2 px-3 mx-3 rounded-md">
            <i v-if="edit" class="fas fa-pen"/>
            {{ tag }}
        </button>

        <div v-if="search"
                class="border-4 border-yellow-300 hover:border-yellow-600
            text-yellow-400 font-bold text-xl h-12 py-2 px-3 mx-3 rounded-md">
            <i v-if="search" class="fas fa-search"/>
            {{ tag }}
        </div>

        <div v-if="link"
                class="border-4 border-blue-300 hover:border-blue-600
            text-bçlue-400 font-bold text-xl h-12 py-2 px-3 mx-3 rounded-md">
            <i v-if="link" class="fas fa-external-link-alt"/>
            {{ tag }}
        </div>

    </div>

</template>

<script>
    export default {

        props: [
            'id',
            'save',
            'edit',
            'search',
            'link',
            'tag',
            'click',
        ]

    }
</script>
