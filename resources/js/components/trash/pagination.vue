<template>
    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">

            <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">

                    <a href="#" @click.prevent="navigate(source.meta.current_page - 1)"
                       class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-400
                       bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">Anterior</span>
                        <i class="fas fa-backward"></i>
                    </a>

                    <div  v-if="current !== 1">
                        <a href="#" @click.prevent="navigate(1)" :class="ifActive(1)">
                            1
                        </a>
                        <p class="bg-white border-gray-300 text-gray-600 hover:bg-gray-50 relative
                              inline-flex items-center -mx-2 px-4 py-2 border text-sm font-medium">
                            ...
                        </p>
                        <a href="#"@click.prevent="navigate(source.meta.current_page -1)" :class="ifActive(!this.current)">
                            {{ current - 1 }}
                        </a>
                    </div>


                    <p  :class="ifActive(this.current)">
                        {{ current }}
                    </p>

                    <div v-if="current !== last" >
                        <a href="#" @click.prevent="navigate(source.meta.current_page +1)"  :class="ifActive(!this.current)">
                            {{ current + 1 }}
                        </a>
                        <p class="bg-white border-gray-300 text-gray-600 hover:bg-gray-50 relative
                              inline-flex items-center -mx-2 px-4 py-2 border text-sm font-medium">
                            ...
                        </p>
                        <a href="#" @click.prevent="navigate(source.meta.last_page)" :class="ifActive(this.last)">
                            {{ last }}
                        </a>
                    </div>


                    <a href="#" @click.prevent="navigate(source.meta.current_page + 1)"
                       class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-400
                       bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">Próxima</span>
                        <i class="fas fa-forward"></i>
                    </a>

                </nav>
            </div>

            <div>
                <p class="text-md text-gray-700">
                    Mostrando
                    <span class="font-medium">{{ from }}</span>
                    a
                    <span class="font-medium">{{ to }}</span>
                    de
                    <span class="font-medium">{{ total }}</span>
                    resultados
                </p>
            </div>

        </div>
    </div>
</template>

<script>

    export default {

        props: [
            'source',
        ],

        data() {
          return {
              from: null,
              to: null,
              total: null,
              current: null,
              last: null,
          }
        },

        watch: {
            source() {
                this.from = this.source.meta.from;
                this.to = this.source.meta.to;
                this.total = this.source.meta.total;
                this.current = this.source.meta.current_page;
                this.last = this.source.meta.last_page;
            },
        },

        methods: {

            navigate(page) {
                // if (page !== 0) {
                if (page <= this.last) {
                    this.$emit('navigate', page)
                }

            },

            ifActive(page) {
                if (page === this.current) {
                    return "z-10 bg-indigo-400 border-indigo-500 text-white relative " +
                        "inline-flex items-center px-4 py-2 border text-sm font-medium"
                } else {
                    return "bg-white border-gray-400 text-gray-700 hover:bg-gray-50 relative " +
                        "inline-flex items-center px-4 py-2 border text-sm font-medium"
                }
            },

        },

    }

</script>
