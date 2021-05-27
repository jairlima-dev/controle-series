<template>

    <div-container>
        <tag-title>Série: {{ nome }}</tag-title>
        <message v-if="message">{{ message }}</message>
        <errors v-if="errors" :errors="errors"/>

        <div-actions>

            <button-link to="seasons.create"
                         :id="this.id"
                         tag="Temporada"
                         type="add"/>
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

        <pagination-default :source="pagination" @navigate="navigate"/>

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
import PaginationDefault from "../../components/shared/pagination-default";
import global from "../../api/global";

    export default {

        components: {
            PaginationDefault,
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
                nome: this.$route.params.nome,
                temporadas: null,
                pagination: null,
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
                api.all(this.id)
                    .then(response => {
                        this.temporadas = response.data.data;
                        this.pagination = response.data;
                }).catch(error =>
                    this.errors = error.response.data.errors);

            },

            episodesCount() {

            },

            navigate(page) {
                global.paginate(page)
                    .then(response => {
                        this.temporadas = response.data.data;
                        this.pagination = response.data;
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors
                    })
            },
        },

    }

</script>
