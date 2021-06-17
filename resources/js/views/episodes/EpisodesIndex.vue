<template>

    <div-container>
        <tag-title>Série: {{ nomeTemporada }} - Temporada {{ numeroTemporada }} </tag-title>
        <message v-if="message">{{ message }}</message>
        <errors-default v-if="error" :error="error"/>

        <div-actions>
            <button-link to="episodes.create"
                         :id="id"
                         :numero="numeroTemporada"
                         tag="Episódio"
                         type="add"/>

            <input-form size="lg" label-text="Filtrar: " display="inline" v-model="filter"/>

        </div-actions>

        <ul v-if="episodios" v-for="episodio in filteredEpisodes" :key="episodio.id" class="flex flex-col">

            <div v-if="showOnEdit === episodio.id" class="flex p-2 border-2 rounded-md intems-center">
                <div class="mt-3">
                    Episódio {{ episodio.numero }} -
                </div>

                <input-form size="lg" v-model="episodio.nome"/>
                <button-action type="save" @execute="editName(episodio)"/>
                <button-action type="cancel" @execute="onEdit()"/>
            </div>

            <li v-if="!showOnEdit" class="flex p-2 border-2 justify-between rounded-md intems-center">

                <div class="title flex-1 p-2 text-xl" >
                    Episódio {{ episodio.numero }} - {{ episodio.nome }}
                </div>

                <div class="action-buttons flex flex-invert">

                    <button-action type="edit" @execute="onEdit(episodio.id)"/>
                    <button-action type="delete" @execute="deleteEpisode(episodio.id)" :confirmation="true"/>
                    <checked-default :id="episodio.id" labelText="Assistido" v-model="episodio.assistido"/>

                </div>
            </li>
        </ul>

        <pagination-default v-show="!showOnEdit" :source="pagination" @navigate="navigate"></pagination-default>

    </div-container>

</template>

<script>

    import api from '../../api/episodes';
    import global from '../../api/global';

    import TagTitle from "../../components/shared/tag-title";
    import Message from "../../components/shared/message";
    import ButtonLink from "../../components/shared/button-link";
    import DivContainer from "../../components/shared/div-container";
    import DivActions from "../../components/shared/div-actions";
    import FilterDefault from "../../components/trash/input-filter";
    import ButtonAction from "../../components/shared/button-action";
    import CheckedDefault from "../../components/shared/checked-default"
    import InputForm from "../../components/shared/input-form";
    import PaginationDefault from "../../components/shared/pagination-default";
    import ErrorsDefault from "../../components/shared/errors-default";
    import { refresh } from "../../utils";

    export default {

        components: {
            ErrorsDefault,
            PaginationDefault,
            InputForm, ButtonAction, CheckedDefault, DivContainer, DivActions,
            FilterDefault, Message, TagTitle, ButtonLink},

        data () {
            return {
                filter: '',
                error: null,
                numeroTemporada: this.$route.params.numero,
                nomeTemporada: this.$route.params.nome,
                hideOnEdit: true,
                showOnEdit: false,
                message: '',
                id: this.$route.params.id,
                episodios: null,
                pagination: null,
            }
        },

        mixins: [refresh],

        created() {
            this.fetchData();
        },

        computed: {
            filteredEpisodes () {
                if (this.filter) {
                    let exp = new RegExp(this.filter.trim(), 'i');
                    return this.episodios.filter(episodio => exp.test(episodio.nome));
                } else {
                    return this.episodios;
                }
            },
        },

        methods: {
            fetchData() {
                api.all(this.$route.params.id)
                    .then(response => {
                        this.episodios = response.data.data;
                        this.pagination = response.data;
                        this.id = this.episodios[0].temporada_id;
                    }).catch(error => this.message = 'Erro ao buscar dados!');
            },

            onEdit(idEpisode) {
                this.showOnEdit = idEpisode;
                this.message = this.error = null;
                if (!this.hideOnEdit) {
                    this.hideOnEdit = true;
                } else {
                    this.hideOnEdit = false;
                }
            },

            editName(episodio) {
                api.update(episodio.id, {nome: episodio.nome})
                    .then(response => {
                        this.onEdit();
                        this.message = `Episódio ${episodio.numero}: ${episodio.nome} Alterado`
                        setTimeout(() => this.message = null, 3000);
                    }).catch(error => {
                        this.error = error.response.data.errors;
                        setTimeout(() => this.error = null, 2000)
                })
            },

            deleteEpisode(id) {
                this.message = 'Efetuando solicitação... Aguarde...'
                api.delete(id)
                    .then(response => {
                        this.message = 'Episódio excluido!';
                        setTimeout(() => this.refresh(), 2000);
                    }).catch(error => {
                        this.message = null;
                        this.error = error.response.data.errors;
                        setTimeout(() => this.error = null, 3000);
                })
            },

            navigate(page) {
                global.paginate(page)
                    .then(response => {
                        this.episodios = response.data.data;
                        this.pagination = response.data;
                    })
                    .catch(error => {
                        this.error = error.response.data.errors
                    })
            },
        },

    }

</script>
