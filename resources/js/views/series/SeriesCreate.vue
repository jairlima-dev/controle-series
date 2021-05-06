<template>

    <div class="border-2 px-4 py-2 rounded-md">

        <tag-title title="Nova Série"/>

<!--        <h1 class="block text-2xl bg-gray-200 mb-2 p-4 font-bold rounded-md">Nova Série</h1>-->

        <message v-if="message" :text="message"/>
<!--        <div v-if="message"-->
<!--             class="alert">-->
<!--            {{ message }}-->
<!--        </div>-->

        <form class="flex" @submit.prevent="onSubmit($event)">

            <div class="mx-1 block">
                <label class="block" for="serie_name">Nome</label>
                <input class="w-96 px-2 py-1 border-2 rounded-md" id="serie_name" v-model="serie.nome" />
            </div>

            <div class="mx-1 block">
                <label class="block" for="qtd_temporadas">Temporadas</label>
                <input class="w-24 px-2 py-1 border-2 rounded-md" id="qtd_temporadas" v-model="serie.temporadas" />
            </div>

            <div class="mx-1 block">
                <label class="block" for="qtd_episodios">Episódios</label>
                <input class="w-24 px-2 py-1 border-2 rounded-md" id="qtd_episodios" v-model="serie.episodios" />
            </div>

            <div class="mx-1 mt-6 w-34 text-white bg-blue-400 py-1 px-6 lg:hover:bg-blue-700 rounded-md">
                <button class="text-center" type="submit" :disabled="saving">
                    {{ saving ? 'Salvando...' : 'Salvar' }}
                </button>
            </div>

        </form>
    </div>
</template>

<script>



    import api from '../../api/series';
    import TagTitle from "../../components/shared/tag-title";
    import Message from "../../components/shared/message";

    export default {
        components: {Message, TagTitle},
        data() {
            return {
                saving: false,
                message: false,
                serie: {
                    nome: '',
                    temporadas: null,
                    episodios: null
                }
            }
        },
        methods: {
            onSubmit($event) {
                this.saving = true
                this.message = false
                // console.log(this.serie);
                api.create(this.serie)
                .then((data) => {
                    // console.log(data);
                    this.$router.push({ name: 'series.index' });
                }).catch((e) => {
                    this.message = e.response.data || 'Processando solicitação...';
                }).then(() => this.saving = false)
            }
        }
    }
</script>

<style scoped>

</style>
