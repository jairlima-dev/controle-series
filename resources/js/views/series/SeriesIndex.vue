<template>

    <div-container>
        <tag-title>Séries</tag-title>
        <message v-if="message">{{ message }}</message>
        <errors-default v-if="error" :error="error"/>

        <div-actions>
            <button-link to="series.create" tag="Série" type="add"/>

            <input-form size="lg" label-text="Buscar : " display="inline" v-model="search"/>
            <button-action @execute="searchSerie" type="search"/>
            <button-action v-if="searching" @execute="cancelSearch" type="cancel"/>

        </div-actions>

        <ul v-if="series" v-for="serie in series" :key="serie.id" class="flex flex-col">

            <div v-if="showOnEdit === serie.id" class="flex p-2 border-2 rounded-md items-center">
                <input-form size="lg" v-model="serie.nome"/>
                <button-action type="save" @execute="editName(serie)" />
                <button-action type="cancel" @execute="onEdit()" />
            </div>

            <li v-if="!showOnEdit" class="flex p-2 border-2 justify-between rounded-md items-center">

                <div class="title flex-1 p-2 text-xl" >
                    {{ serie.nome }}
                </div>

                <div class="action-buttons flex flex-invert">
                    <button-link type="link" :confirm="true"  to='seasons.index' :id="serie.id" :nome="serie.nome"/>
                    <button-action type="edit" @execute="onEdit(serie.id)"/>
                    <button-action type="delete" @execute="deleteSerie(serie)" :confirmation="true"/>
                </div>

            </li>
        </ul>

        <div>
            <pagination-default v-show="!showOnEdit" :source="pagination" @navigate="navigate"></pagination-default>
        </div>

    </div-container>

</template>

<script>
    import api from '../../api/series';
    import global from "../../api/global";
    import { refresh } from '../../utils'

    import TagTitle from "../../components/shared/tag-title";
    import ButtonLink from "../../components/shared/button-link";
    import GridDefault from "../../components/trash/grid-default";
    import DivContainer from "../../components/shared/div-container";
    import DivActions from "../../components/shared/div-actions";
    import ButtonAction from "../../components/shared/button-action"
    import ErrorsDefault from "../../components/shared/errors-default";
    import Message from "../../components/shared/message"
    import InputForm from "../../components/shared/input-form";
    import PaginationDefault from "../../components/shared/pagination-default"

    export default {
        components: {
            ErrorsDefault, Message, PaginationDefault, InputForm, DivActions, ButtonAction,
            DivContainer, GridDefault, ButtonLink, TagTitle
        },

        data() {
            return {
                message: 'Carregando...',
                error: null,
                hideOnEdit: true,
                showOnEdit: false,
                search: '',
                id: null,
                seriesSearch: null,
                searching: false,
                series: null,
                pagination: null,
            };
        },

        mixins: [refresh],

        created() {
            this.fetchData()
        },

        methods: {
            fetchData() {
                api.all()
                    .then(response => {
                        this.message = this.error = null;
                        this.series = response.data.data;
                        this.pagination = response.data;
                    })
                    .catch(error => {
                        this.error = error.response.data.errors;
                    })
            },

            navigate(page) {
                global.paginate(page)
                    .then(response => {
                        this.series = response.data.data;
                        this.pagination = response.data;
                    })
                    .catch(error => {
                        this.error = error.response.data.errors;
                    })
            },

            searchSerie() {
                api.search(this.search)
                    .then(response => {
                        this.pagination = null;
                        this.series = response.data.data;
                        this.pagination = response.data;
                        this.searching = true;
                    }).catch(error => {
                        this.error = error.response.data.errors;
                        setTimeout(() => this.error = null, 2000);
                });
            },

            cancelSearch() {
                this.search = null;
                this.fetchData();
                this.searching = false;
            },

            onEdit(id) {
                this.showOnEdit = id;
                this.message = this.error = null;
            },

            editName(serie) {
                api.update(serie.id, {nome: serie.nome})
                    .then(() => {
                        this.error = null;
                        this.onEdit();
                        this.message = `Série Alterada: ${serie.nome}`;
                        setTimeout(() => this.message = null, 3000);
                    }).catch(error => {
                        this.error = error.response.data.errors
                })
            },

            deleteSerie(serie) {
                this.message = 'Efetuando solicitação. Aguarde...';
                api.delete(serie.id)
                    .then(response => {
                        this.message = `Série "${serie.nome}" excluída!`;
                        setTimeout(() => this.refresh(), 3000);
                    })
                    .catch(error => {
                        this.error = error.response.data.errors
                    })
            },
        },
    }


</script>
