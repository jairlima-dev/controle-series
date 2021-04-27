<template>

    <div class="series">

        <div v-if="error" class="error">
            {{ error }}

            <p>
                <button
                    class="text-white bg-yellow-400 py-2 px-6 hover:bg-yellow-600 rounded-md"
                    @click.prevent="fetchData">
                    Try Again
                </button>
            </p>

        </div>

        <ul v-if="series">
            <li v-for="{name, id} in series">

                <router-link :to="{ name: 'series.edit', params: { id } }">
                   Edit
                </router-link>
                Título :{{ name }}

            </li>
        </ul>

        <div class="pagination">
            <button :disabled="! prevPage" @click.prevent="goToPrev">Previous</button>
            {{ paginatonCount }}
            <button :disabled="! nextPage" @click.prevent="goToNext">Next</button>
        </div>

    </div>

</template>

<script>

    import axios from 'axios';

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
        data() {
            return {
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
        }
    }
</script>
