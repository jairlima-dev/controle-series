<template>
    <div-container>
        <tag-title title="Séries"/>

        <div v-if="error" class="error">
            {{ error }}
            <p>
                <button
                    class="text-white bg-yellow-500 py-2 px-6 hover:bg-yellow-700 rounded-md"
                    @click.prevent="fetchData">
                    Try Again
                </button>
            </p>
        </div>

        <div-actions>

            <button-link to="series.create" tag="Série" add="true"/>

            <div class="flex items-center">

                <form class="flex items-end" @submit.prevent="onSubmit($event)">
                    <label for="search">Buscar: </label>
                    <input class="w-96 border-2 ml-4 px-2 py-2 rounded-md"
                           type="search" id="search"
                           placeholder="Digite aqui a sua busca"
                           v-model="exp">
                    <button-action search="true"/>
                </form>
            </div>

<!--            <filter-default :value="filter"/>-->

        </div-actions>

        <ul class="flex flex-col" v-if="series">

            <li class="flex p-2 border-2 justify-between rounded-md items-center"
                v-for="serie in searched" :key="serie.id">

                <div class="title flex-1 p-2 text-xl" >

                    <div v-if="!edit">
                        {{ serie.nome }}
                    </div>

                    <div v-else-if="serieId === serie.id" class="flex">
                        <input class="w-96 px-2 py-1 mr-2 border rounded-md "
                               type="text" v-model="serie.nome"/>
                        <button-link save="true" to="series.edit" :id="serie.id" :data="serie.nome"/>
                    </div>

                </div>

                <div class="action-buttons flex flex-invert">
                    <button-link to='seasons.index' :id="serie.id" link="true"/>
                    <button @click="onEdit(serie.id)" class="border-4 border-yellow-300 hover:border-yellow-600
                            text-yellow-400 font-bold text-xl h-12 py-2 px-3 mr-2 rounded-md">
                        <i class="fas fa-pen"/></button>
                    <button-link to='series.delete' :id="serie.id" del="true"/>
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

    import TagTitle from "../../components/shared/tag-title";
    import ButtonLink from "../../components/shared/button-link";
    import GridDefault from "../../components/shared/grid-default";
    import FilterDefault from "../../components/shared/filter-default";
    import DivContainer from "../../components/shared/div-container";
    import DivActions from "../../components/shared/div-actions";
    import ButtonAction from "../../components/shared/button-action"

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

        components: {DivActions, ButtonAction, DivContainer, FilterDefault,
            GridDefault, ButtonLink, TagTitle},

        data() {

            return {
                edit: false,
                serieId: false,
                filter: '',
                exp: '',
                id: null,
                series: null,
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


            searched () {

                if (this.filter) {
                    let exp = new RegExp(this.filter.trim(), 'i');
                    return this.series.filter(serie => exp.test(serie.nome));
                } else {
                    return this.series;
                }

            },

            filtered () {

                if (this.filter) {
                    let exp = new RegExp(this.filter.trim(), 'i');
                    return this.series.filter(serie => exp.test(serie.nome));
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
            onEdit(idSerie) {
                this.serieId = idSerie;
                if (!this.edit) {
                    this.edit = true;
                } else  {
                    this.edit = false;
                }
            },

            onSubmit($event) {
                api.search(this.key)
                    .then(response => {
                        console.log(response);
                    });
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
