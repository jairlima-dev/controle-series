<template>
    <div-container>
        <tag-title>Séries</tag-title>
        <errors v-if="errors" :errors="errors"/>

        <div-actions>
            <button-link to="series.create" tag="Série" type="add"/>

            <input-form size="lg" label-text="Buscar : " display="inline" v-model="search"/>
            <button-action @execute="searchSerie" type="search"/>
            <button-action v-if="searching" @execute="cancelSearch" type="cancel"/>

        </div-actions>

        <ul v-if="series" v-for="serie in series" :key="serie.id" class="flex flex-col">

            <li class="flex p-2 border-2 justify-between rounded-md items-center">

                <div class="title flex-1 p-2 text-xl" >

                    <div v-if="hideOnEdit">
                        {{ serie.nome }}
                    </div>

                    <div v-else-if="showOnEdit === serie.id" class="flex">
                        <input-form size="lg" v-model="serie.nome"></input-form>
                        <button-link type="save" to="series.edit" :id="serie.id"
                                     :nome="serie.nome"/>
                        <button-action type="cancel" @execute="onEdit()" />
                    </div>

                </div>

                <div  v-if="!showOnEdit" class="action-buttons flex flex-invert">
                    <button-link type="link" :confirm="true"  to='seasons.index' :id="serie.id"/>
                    <button-action type="edit" @execute="onEdit(serie.id)"/>
                    <button-link type="delete" to='series.delete' :id="serie.id"/>
                </div>

            </li>
        </ul>

        <div>
            <pagination-default :source="pagination" @navigate="navigate"></pagination-default>
        </div>

    </div-container>
</template>

<script>

    import api from '../../api/series'

    import TagTitle from "../../components/shared/tag-title";
    import ButtonLink from "../../components/shared/button-link";
    import GridDefault from "../../components/shared/grid-default";
    import FilterDefault from "../../components/shared/input-filter";
    import DivContainer from "../../components/shared/div-container";
    import DivActions from "../../components/shared/div-actions";
    import ButtonAction from "../../components/shared/button-action"
    import Errors from "../../components/shared/errors";
    import InputForm from "../../components/shared/input-form";
    import Pagination from "../../components/shared/pagination"
    import PaginationDefault from "../../components/shared/pagination-default"

    export default {

        components: {
            Errors, Pagination, PaginationDefault, InputForm, DivActions, ButtonAction,
            DivContainer, FilterDefault, GridDefault, ButtonLink, TagTitle},

        data() {

            return {
                errors: null,
                hideOnEdit: true,
                showOnEdit: false,
                search: '',
                id: null,
                series: null,
                seriesSearch: null,
                searching: false,
                pagination: null,
            };
        },

        created() {

            this.fetchData();

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
                if (!this.hideOnEdit) {
                    this.hideOnEdit = true;
                } else  {
                    this.hideOnEdit = false;
                }
            },

            navigate(page) {
                api.paginate(page)
                    .then(response => {
                        this.series = response.data.data;
                        this.pagination = response.data;
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors
                    })

            },

        },
    }

</script>
