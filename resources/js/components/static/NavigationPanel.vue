<template>
    <main class="flex h-screen pb-6 rounded-sm">

        <aside v-if="currentToken" class="max-h-screen bg-gray-600 text-white py-4 px-4 w-1/5 rounded-2xl cursor-pointer">
            <div class="buttons flex justify-between mb-4">


                <button @click="logout" class="text-white text-2xl bg-red-600 w-14 h-14
                            p-3 border-2 border-gray-500 rounded-full">
                    <font-awesome-icon icon="power-off"/>
                    <p class="text-center text-sm mt-2">Sair</p>
                </button>

                <div class="text-2xl bg-white text-black w-14 h-14
                            p-3 border-2 border-gray-500 rounded-full">
                    <router-link :to="{ name: 'series.index' }" class="justify-center">
                        <font-awesome-icon icon="home"/>
                        <p class="text-center text-sm text-white mt-2 -ml-1">Home</p>
                    </router-link>
                </div>

            </div>

            <hr>

            <p class="text-center m-2">Categorias</p>

            <ul>
                <router-link :to="{ name: 'series.index' }" exact>
                    <li class="text-black text-lg bg-white border-2 hover:border-black
                        p-1 my-3 w-auto rounded-full py-2 px-6">
                        Séries
                    </li>
                </router-link>

                <router-link :to="{ name: 'movies.index' }" exact>
                    <li class="text-black text-lg bg-white border-2 hover:border-black
                        p-1 my-3 w-auto rounded-full py-2 px-6">
                        Filmes
                    </li>
                </router-link>

                <router-link :to="{ name: 'documentaries.index' }" exact>
                    <li class="text-black text-lg bg-white border-2 hover:border-black
                        p-1 my-3 w-auto rounded-full py-2 px-6">
                        Documentários
                    </li>
                </router-link>

            </ul>

           <navigation-admin v-if="loggedUser.id === 1" />

            <ul>
                <router-link :to="{ name: 'about' }" exact>
                    <li class="text-black text-lg bg-white border-2 hover:border-black
                        p-1 my-3 w-auto rounded-full py-2 px-6">
                        About
                    </li>
                </router-link>

            </ul>

        </aside>

        <div class="primary flex-1 px-2 ml-2">
            <errors-default v-if="getMessage" :error="getMessage"/>
            <router-view></router-view>
        </div>

    </main>

</template>

<script>
    import { mapGetters } from 'vuex'
    import { logout } from "../../utils";
    import ErrorsDefault from "../shared/errors-default";
    import NavigationAdmin from "./NavigationAdmin";

    export default {
        name: "NavigationPanel",
        components: {NavigationAdmin, ErrorsDefault},
        computed: {
            ...mapGetters(['loggedUser', 'currentToken', 'getMessage'])
        },

        mixins: [logout],


    }
</script>
