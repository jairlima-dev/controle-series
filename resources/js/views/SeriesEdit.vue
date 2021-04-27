<template>

    <div>

        <div v-if="message"
             class="alert red-600 p-2 mb-1 w-50 border-red-100-1 rounded-md bg-red-100 block">
            {{ message }}
        </div>

        <div v-if="! loaded">Loading...</div>

        <form class="block" @submit.prevent="onSubmit($event)">

            <div>
                <label class="block" for="serie_name">Série</label>
                <input class="border rounded-md block" id="serie_name" v-model="serie.name"/>
            </div>


                <button class="text-white bg-yellow-400 py-1 px-6 my-2 hover:bg-yellow-600 rounded-md"
                        type="submit" :disabled="saving">Salvar
                </button>



        </form>

    </div>

</template>

<script>

    import api from '../api/series';

    export default {

        data() {

            return {

                message: null,
                loaded: false,
                saving: false,
                serie: {
                    id: null,
                    name: ''
                }

            }
        },

        created() {

            api.find(this.$route.params.id).
            then((response) => {
                this.loaded = true;
                this.serie = response.data.data;
            }).catch(error => {
                console.log(error);
            });

        },

        methods: {

            onSubmit(event) {
                api.update(this.serie.id, {
                   name: this.serie.name
                }).then((response) => {
                    this.message = 'Série Alterada';
                    setTimeout(() => this.message = null, 2000)
                    this.serie = response.data.data;
                }).catch(error => {
                    console.log(error);
                }).then(_ => this.saving = false);

            },

        },

    }

</script>
