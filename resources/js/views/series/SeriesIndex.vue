<template>
    <div-container>
        <tag-title>Séries</tag-title>
        <errors v-if="errors" :errors="errors"/>

        <div-actions>
            <button-link to="series.create" tag="Série" type="add"/>

            <input-form size="lg" label-text="Buscar : " display="inline" v-model="search"/>
<!--            <input-form size="lg" label-text="Filtrar: " display="inline" v-model="searching"/>-->
            <button-action @execute="searchSerie" type="search"/>

        </div-actions>

        <ul v-if="series" v-for="serie in searchedSeries" :key="serie.id" class="flex flex-col">

            <li class="flex p-2 border-2 justify-between rounded-md items-center">

                <div class="title flex-1 p-2 text-xl" >

                    <div v-if="!editNome">
                        {{ serie.nome }}
                    </div>

                    <div v-else-if="serieId === serie.id" class="flex">
                        <input-form size="lg" v-model="serie.nome"></input-form>
                        <button-link type="save" to="series.edit" :id="serie.id"
                                     :nome="serie.nome"/>
                        <button-action type="cancel" @execute="onEdit()" />
                    </div>

                </div>

                <div  v-if="!editNome" class="action-buttons flex flex-invert">
                    <button-link type="link" :confirme="true"  to='seasons.index' :id="serie.id"/>
                    <button-action type="edit" @execute="onEdit(serie.id)"/>
                    <button-link type="delete" to='series.delete' :id="serie.id"/>
                </div>

            </li>
        </ul>

        <div class="pagination my-2">
            <button :disabled="! prevPage" @click.prevent="goToPrev">Anterior</button>
            {{ paginatonCount }}
            <button :disabled="! nextPage" @click.prevent="goToNext">Próxima</button>
        </div>

    </div-container>
</template>

<script>

    import axios from 'axios';
    import api from '../../api/series'

    import TagTitle from "../../components/shared/tag-title";
    import ButtonLink from "../../components/shared/button-link";
    import GridDefault from "../../components/shared/grid-default";
    import FilterDefault from "../../components/shared/input-filter";
    import DivContainer from "../../components/shared/div-container";
    import DivActions from "../../components/shared/div-actions";
    import ButtonAction from "../../components/shared/button-action"
    import Errors from "../../components/shared/errors";
    import ImputForm from "../../components/shared/input-form"
    import InputForm from "../../components/shared/input-form";
    import FormFilter from "../../components/shared/input-filter";
    import InputFilter from "../../components/shared/input-filter";

    const getSeries = (page, callback) => {
    const params = { page };

        axios
            .get('/api/series', { params })
            .then(response => {
                callback(null, response.data);
            }).catch(error => {
            callback(error, error.response.data);
        });

    };

    export default {

        components: {
            InputFilter,
            FormFilter,
            InputForm,
            Errors, ImputForm, DivActions, ButtonAction, DivContainer, FilterDefault,
            GridDefault, ButtonLink, TagTitle},

        data() {

            return {
                errors: null,
                editNome: false,
                serieId: false,
                filter: '',
                id: null,
                search: '',
                series: null,
                seriesSearch: null,
                meta: null,
                links: {
                    first: null,
                    last: null,
                    next: null,
                    prev: null,
                },
                error: null,
            };
        },

        computed: {

            filteredSeries () {
                if (this.filter) {
                    let exp = new RegExp(this.filter.trim(), 'i');
                    return this.series.filter(serie => exp.test(serie.nome));
                } else {
                    return this.series;
                }
            },

            searchedSeries () {
                if (this.seriesSearch) {
                    return this.seriesSearch;
                } else {
                    return this.series;
                }
            },

            nextPage() {
                if (! this.meta || this.meta.current_page === this.meta.last_page) {
                    return;
                }

                return this.meta.current_page + 1;
            },

            prevPage() {
                if (! this.meta || this.meta.current_page === 1) {
                    return;
                }

                return this.meta.current_page - 1;
            },

            paginatonCount() {
                if (! this.meta) {
                    return;
                }

                const { current_page, last_page } = this.meta;

                return `${current_page} of ${last_page}`;
            },
        },

        beforeRouteEnter (to, from, next) {
            getSeries(to.query.page, (err, data) => {
                next(vm => vm.setData(err, data));
            });
        },

        // when route changes and this component is already rendered,
        // the logic will be slightly different.
        beforeRouteUpdate (to, from, next) {
            this.series = this.links = this.meta = null
            getSeries(to.query.page, (err, data) => {
                this.setData(err, data);
                next();
            });
        },

        methods: {
            searchSerie() {
                console.log(this.search)
                api.search({exp: this.search})
                    .then(response => {
                        console.log(response)
                        this.seriesSearch = response.data.data;
                    }).catch(error => {
                        this.errors = error.response.data.errors;
                        setTimeout(() => this.errors = null, 2000);
                });
            },

            onEdit(idSerie) {
                this.serieId = idSerie;
                if (!this.editNome) {
                    this.editNome = true;
                } else  {
                    this.editNome = false;
                }
            },

            goToNext() {
                this.$router.push({
                    query: {
                        page: this.nextPage,
                    },
                });
            },
            goToPrev() {
                this.$router.push({
                    name: 'series.index',
                    query: {
                        page: this.prevPage,
                    }
                });
            },

            setData(err, { data: series, links, meta }) {
                if (err) {
                    this.error = err.toString();
                } else {
                    this.series = series;
                    this.links = links;
                    this.meta = meta;
                }
            },
        },
    }

</script>
