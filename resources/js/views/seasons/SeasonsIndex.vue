<template>

    <div-container>
        <tag-title>Série: {{ nome }}</tag-title>
        <message v-if="message">{{ message }}</message>
        <errors-default v-if="error" :error="error"/>

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
    import global from "../../api/global";
    import { verifyToken } from "../../utils";

    import TagTitle from "../../components/shared/tag-title";
    import ErrorsDefault from "../../components/shared/errors-default";
    import Message from "../../components/shared/message";
    import GridDefault from "../../components/shared/grid-default";
    import DivContainer from "../../components/shared/div-container";
    import ButtonAction from "../../components/shared/button-action";
    import ButtonLink from "../../components/shared/button-link"
    import DivActions from "../../components/shared/div-actions";
    import InputForm from "../../components/shared/input-form";
    import PaginationDefault from "../../components/shared/pagination-default";

    export default {

        components: {
            PaginationDefault, InputForm, DivActions, ErrorsDefault, ButtonAction,
            ButtonLink, DivContainer, GridDefault, Message, TagTitle
        },

        data() {
            return {
                filter: '',
                error: null,
                assistido: 3,
                total: 8,
                message: '',
                id: this.$route.params.id,
                nome: this.$route.params.nome,
                temporadas: null,
                pagination: null,
            }
        },

        mixins: [verifyToken],

        created() {
            this.fetchData()
        },

        computed: {
            filteredTemporadas() {
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
                        this.error = error.response.data.errors);

            },

            navigate(page) {
                global.paginate(page)
                    .then(response => {
                        this.temporadas = response.data.data;
                        this.pagination = response.data;
                    })
                    .catch(error => {
                        this.error = error.response.data.errors
                    })
            },

        }
    }

</script>
