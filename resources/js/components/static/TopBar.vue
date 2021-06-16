<template>
    <div class="flex bg-gray-600 text-white py-2 mb-4 h-24 rounded-xl items-center justify-between">

        <div class="text-4xl py-2 px-6 font-bold">
            Controle Remoto
        </div>

        <router-link :to="{ name: 'about' }">
            <div v-if="currentToken" class="text-2xl mx-12">
                <font-awesome-icon icon="user"/>
                <span class="m-2">Olá! {{ loggedUser.name }}</span>
            </div>
        </router-link>

    </div>
</template>

<script>

    import { mapGetters } from 'vuex'

    export default {
        name: "TopBar",
        computed: {
            ...mapGetters(['loggedUser', 'currentToken'])
        },

    }
</script>
