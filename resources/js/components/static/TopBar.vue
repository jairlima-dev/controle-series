<template>
    <div class="flex bg-gray-600 text-white py-2 mb-4 h-24 rounded-xl items-center justify-between">

        <div class="text-4xl py-2 px-6 font-bold">
            Controle Remoto
        </div>

        <div v-if="currentToken" class="text-2xl text-gray-200">
            <auto-logout> 
                Você será desconectado em alguns segundos:
            </auto-logout>
        </div>

        <router-link :to="{ name: 'about' }">
            <div v-if="currentToken" class="text-2xl mx-12">
                <font-awesome-icon icon="user"/>
                <span class="m-2">Olá! {{ loggedUser.name }}</span>
                <font-awesome-icon icon="caret-down"/>
            </div>
        </router-link>

    </div>
</template>

<script>

    import { mapGetters } from 'vuex'
    import AutoLogout from "../shared/auto-logout";

    export default {
        name: "TopBar",
        components: {AutoLogout},
        computed: {
            ...mapGetters(['loggedUser', 'currentToken'])
        },

    }
</script>
