<template>
    <div class="container mx-auto">
        <div class="bg-gray-600 text-white py-4 mb-4 h-24 rounded-xl">
            <div class="text-4xl py-2 px-6 font-bold">
                Controle Remoto
            </div>
        </div>
        <main class="flex h-screen pb-6 rounded-sm">
            <aside v-if="this.$store.state.token" class="bg-gray-600  text-white py-4 px-4 w-1/5 rounded-2xl cursor-pointer">
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

                <div class="buttons-circle flex justify-between items-center my-6">
                    <div class="rounded-full bg-white text-black text-2xl
                        h-12 w-12 p-2 px-1 text-gray-800 border-2 hover:border-black text-center">
                        <font-awesome-icon icon="cog"/>
                    </div>

                    <div class="rounded-full text-green-500 w-23 h-23 p-4 bg-white border-2 hover:border-black">
                        <font-awesome-icon icon="check"/>
                    </div>


                    <router-link :to="{ name: 'login' }">
                        <div class="rounded-full bg-white text-black text-2xl h-12 w-12 px-3 py-2  border-2 hover:border-black">
                            <font-awesome-icon icon="user"/>
                        </div>
                    </router-link>

                </div>

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
                <router-view></router-view>
            </div>
        </main>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "App",

        methods: {
            logout() {
                axios.post('/api/logout', { token: this.$store.state.token })
                .then(() => {
                    this.$store.commit('clearToken');
                    this.$router.push({ name: 'login'});
                })
            }
        },
    }

</script>
