<template>

    <div class="border-2 px-4 py-2 rounded-md">

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

        <div class="actions flex my-4">

            <button-link to="series.create" tag="Novo" blue="true"/>

            <filter-default :filte="filter"/>

        </div>

        <ul class="flex flex-col" v-if="series">

            <li class="flex p-2 border-2 justify-between" v-for="{id, nome } in series">

                <div class="title flex-1 p-2 text-xl">
                    {{ nome }}
                </div>

                <div class="action-buttons flex flex-invert">

                    <button-link to='seasons.index' :id="id" blue="true">
                        <i class="fas fa-external-link-alt"/>
                    </button-link>


                    <button-link to='series.edit' :id="id" yellow="true">
                        <i class="fas fa-pen"/>
                    </button-link>


                    <button-link to='series.delete' :id="id" red="true">
                        <i class="fas fa-trash-alt"/>
                    </button-link>

                </div>

            </li>

        </ul>

        <div class="pagination my-2">
            <button :disabled="! prevPage" @click.prevent="goToPrev">Anterior</button>
            {{ paginatonCount }}
            <button :disabled="! nextPage" @click.prevent="goToNext">Próxima</button>
        </div>

    </div>

</template>

<script>

    import axios from 'axios';

    import TagTitle from "../../components/shared/tag-title";
    import ButtonLink from "../../components/shared/button-link";
    import GridDefault from "../../components/shared/grid-default";
    import FilterDefault from "../../components/shared/filter-default";

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

        components: {FilterDefault, GridDefault, ButtonLink, TagTitle},

        data() {

            return {
                filter: null,
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
