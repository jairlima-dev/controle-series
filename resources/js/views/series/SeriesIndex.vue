<template>
    <div-container>
        <tag-title>Séries</tag-title>
        <message v-if="message">{{ message }}</message>
        <errors v-if="errors" :errors="errors"/>

        <div-actions>
            <button-link to="series.create" tag="Série" type="add"/>

            <input-form size="lg" label-text="Buscar : " display="inline" v-model="search"/>
            <button-action @execute="searchSerie" type="search"/>
            <button-action v-if="searching" @execute="cancelSearch" type="cancel"/>

        </div-actions>

        <ul v-if="series" v-for="serie in series" :key="serie.id" class="flex flex-col">

            <div v-if="showOnEdit === serie.id" class="flex p-2 border-2 rounded-md items-center">
                <input-form size="lg" v-model="serie.nome"/>
                <button-action type="save" @execute="editName(serie.id, serie.nome)" />
                <button-action type="cancel" @execute="onEdit()" />
            </div>

            <li v-if="!showOnEdit" class="flex p-2 border-2 justify-between rounded-md items-center">

                <div class="title flex-1 p-2 text-xl" >
                    {{ serie.nome }}
                </div>

                <div class="action-buttons flex flex-invert">
                    <button-link type="link" :confirm="true"  to='seasons.index' :id="serie.id" :nome="serie.nome"/>
                    <button-action type="edit" @execute="onEdit(serie.id)"/>
                    <button-action type="delete" @execute="deleteSerie(serie.id, serie.nome)" :confirmation="true"/>
                </div>

            </li>
        </ul>

        <div>
            <pagination-default v-show="!showOnEdit" :source="pagination" @navigate="navigate"></pagination-default>
        </div>

    </div-container>
</template>

<script>

    import api from '../../api/series'
    import global from '../../api/global'

    import TagTitle from "../../components/shared/tag-title";
    import ButtonLink from "../../components/shared/button-link";
    import GridDefault from "../../components/shared/grid-default";
    import FilterDefault from "../../components/shared/input-filter";
    import DivContainer from "../../components/shared/div-container";
    import DivActions from "../../components/shared/div-actions";
    import ButtonAction from "../../components/shared/button-action"
    import Errors from "../../components/shared/errors";
    import Message from "../../components/shared/message"
    import InputForm from "../../components/shared/input-form";
    import PaginationDefault from "../../components/shared/pagination-default"

    export default {

        components: {
            Errors, Message, PaginationDefault, InputForm, DivActions, ButtonAction,
            DivContainer, FilterDefault, GridDefault, ButtonLink, TagTitle},

        data() {

            return {
                message: '',
                errors: null,
                hideOnEdit: true,
                showOnEdit: false,
                search: '',
                id: null,
                series: null,
                seriesSearch: null,
                searching: false,
                pagination: null,
                reload: null
            };
        },

        created() {
            this.fetchData();
        },

        watch: {
            reload() {
                this.fetchData();
            }
        },

        methods: {

            fetchData() {
                api.all()
                    .then(response => {
                        this.series = response.data.data;
                        this.pagination = response.data;
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    })
            },

            navigate(page) {
                global.paginate(page)
                    .then(response => {
                        this.series = response.data.data;
                        this.pagination = response.data;
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors
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
                        this.errors = error.response.data.errors;
                        setTimeout(() => this.errors = null, 2000);
                });
            },


            cancelSearch() {
              this.search = null;
              this.fetchData();
              this.searching = false;
            },

            onEdit(idSerie) {
                this.showOnEdit = idSerie;
                this.message = this.errors = null;
            },

            onDelete() {
                this.message = this.errors = null;
                this.fetchData()
            },

            editName(id, name) {
                api.update(id, {nome: name})
                    .then(() => {
                        this.errors = null;
                        this.onEdit();
                        this.message = `Série Alterada: ${name}`;
                        setTimeout(() => this.message = null, 3000);
                    }).catch(error => {
                        this.errors = error.response.data.errors
                    });
            },

            deleteSerie(id, nome) {
                this.message = 'Efetuando solicitação. Aguarde...';
                api.delete(id)
                    .then((response) => {
                        this.errors = null;
                        this.onDelete();
                        this.message = `Série: "${nome}" excluida!`;
                        setTimeout(() => this.message = null, 4000);
                    })
                    .catch((error) => {
                        this.errors = error.response.data.errors
                    })
            },


        },
    }

</script>
