<template>

    <div class="border-2 px-4 py-2 rounded-md">

        <tag-title :title="nome"/>

        <message v-if="message" :text="message"/>

        <ul class="flex flex-col" v-if="temporadas">

            <li class="flex p-2 border-2 justify-between intems-center" v-for="{ id, numero } in temporadas">

                <div class="title flex-1 p-2 text-xl items-center">
                    <router-link :to="{ name: 'season.episodes', params: { id }}">
                        Temporada - {{ numero }}
                    </router-link>
                </div>

                <div class="text-center text-xl">

                    <span class="text-sm">{{assistido}}/{{total}}</span>

                </div>


            </li>
        </ul>

    </div>

</template>

<script>

import api from '../../api/seasons';
import TagTitle from "../../components/shared/tag-title";
import Message from "../../components/shared/message";
import GridDefault from "../../components/shared/grid-default";

    export default {

        components: {GridDefault, Message, TagTitle},

        data () {
            return {
                assistido: 2,
                total: 10,
                message: '',
                id: null,
                nome: '',
                temporadas: null
            }
        },

        created() {
            this.fetchData();
        },

        methods: {
            fetchData() {
                api.all(this.$route.params.id)
                    .then(response => {
                        console.log(response);
                        this.nome = response.data.data[0].nome;
                        this.temporadas = response.data.data[0].temporadas
                }).catch(error => this.message = 'Erro ao carregar os dados!');
            },

            episodesCount() {

            }
        },




    }

</script>
