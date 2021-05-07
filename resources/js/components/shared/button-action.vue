<template>

    <button type="submit" :disabled="saving"
            v-if="save" class="border-4 border-blue-300 hover:border-blue-600
            text-blue-400 font-bold text-xl py-1 px-2 mr-2 rounded-md">
            <i v-if="link" class="fas fa-check"/>
<!--        {{ saving ? 'Salvando...' : 'Salvar' }}-->
        {{ tag }}
<!--        <slot></slot>-->
    </button>

</template>

<script>
    export default {
        data () {
            return {
                saving: false,
            }
        },

        props: [
            'save',
            'tag'
        ]
    }
</script>

<style scoped>

</style>
