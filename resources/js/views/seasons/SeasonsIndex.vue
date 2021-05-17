<template>

    <div-container>
        <tag-title :title="nome"/>
        <message v-if="message" :text="message"/>

        <div-actions>

            <button-link to="seasons.create" :id="id" tag="Temporada" add="true"/>
            <filter-default value="filter"/>

        </div-actions>

        <ul class="flex flex-col" v-if="temporadas">

            <li class="flex p-2 border-2 justify-between intems-center"
                v-for="{ id, numero } in temporadas">

                <div class="flex items-center" >

                    <div class="title flex flex-1 p-2 text-xl">
                        Temporada - {{ numero }}
                    </div>

                    <div class="text-center text-lg">
                        <span class="text-sm"> - Assistidos: {{assistido}}/{{total}}</span>
                    </div>

                </div>

                <div class="action-buttons flex flex-invert">
                    <button-link to="season.episodes" :id="id" link="true"/>
                </div>


            </li>
        </ul>

    </div-container>

</template>

<script>

import api from '../../api/seasons';
import TagTitle from "../../components/shared/tag-title";
import Message from "../../components/shared/message";
import GridDefault from "../../components/shared/grid-default";
import DivContainer from "../../components/shared/div-container";
import ButtonAction from "../../components/shared/button-action";
import ButtonLink from "../../components/shared/button-link"
import DivActions from "../../components/shared/div-actions";
import FilterDefault from "../../components/shared/filter-default"

    export default {

        components: {DivActions, FilterDefault, ButtonAction, ButtonLink, DivContainer, GridDefault, Message, TagTitle},

        data () {
            return {
                filter: '',
                assistido: 3,
                total: 8,
                message: '',
                id: this.$route.params.id,
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
                        // console.log(response);
                        this.id = response.data.data[0].id;
                        this.nome = response.data.data[0].nome;
                        this.temporadas = response.data.data[0].temporadas;
                }).catch(error => this.message = 'Erro ao carregar os dados!');

            },

            episodesCount() {

            }
        },




    }

</script>
