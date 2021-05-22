<template>

    <div-container>
        <tag-title>Série: {{ nome }}</tag-title>
        <message v-if="message">{{ message }}</message>
        <errors v-if="errors" :errors="errors"/>

        <div-actions>

            <button-link type="add" to="seasons.create" :id="id" tag="Temporada"/>
            <input-form size="lg" label-text="Filtrar: " display="inline" v-model="filter"/>

        </div-actions>

        <ul v-if="temporadas" v-for="temporada in filteredTemporadas" class="flex flex-col">

            <li class="flex p-2 border-2 justify-between intems-center">

                <div class="flex items-center" >

                    <div class="title flex flex-1 p-2 text-xl">
                        Temporada - {{ temporada.numero }}
                    </div>

                    <div class="text-center text-lg">
                        <span class="text-sm"> - Assistidos: {{assistido}}/{{total}}</span>
                    </div>

                </div>

                <div class="action-buttons flex flex-invert">
                    <button-link to="season.episodes"
                                 :id="temporada.id"
                                 :numero="temporada.numero"
                                 :nome="nome"
                                 type="link"/>
                </div>


            </li>
        </ul>

    </div-container>

</template>

<script>

import api from '../../api/seasons';
import TagTitle from "../../components/shared/tag-title";
import Errors from "../../components/shared/errors";
import Message from "../../components/shared/message";
import GridDefault from "../../components/shared/grid-default";
import DivContainer from "../../components/shared/div-container";
import ButtonAction from "../../components/shared/button-action";
import ButtonLink from "../../components/shared/button-link"
import DivActions from "../../components/shared/div-actions";
import FilterDefault from "../../components/shared/input-filter"
import InputForm from "../../components/shared/input-form";

    export default {

        components: {
            InputForm, DivActions, Errors, FilterDefault, ButtonAction, ButtonLink, DivContainer,
            GridDefault, Message, TagTitle},

        data () {
            return {
                filter: '',
                errors: null,
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

        computed: {
            filteredTemporadas () {
                if (this.filter) {
                    let exp = new RegExp(this.filter.trim(), 'i');
                    return this.temporadas.filter(temporada => exp.test(temporada.numero));
                } else {
                    return this.temporadas;
                }
            },
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
