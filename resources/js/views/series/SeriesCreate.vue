<template>

    <div-container>

        <tag-title title="Nova Série"/>

        <message v-if="message" :text="message"/>


        <form class="flex items-end" @submit.prevent="onSubmit($event)">

<!--            <input-form id="nome" big="true" label-text="Nome" -->
<!--                        input-id="serie_name" v-model="serie.nome"> </input-form>-->

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

            <button-action save="true" tag="Salvar"/>

        </form>

    </div-container>

</template>

<script>

    import api from '../../api/series';
    import TagTitle from "../../components/shared/tag-title";
    import Message from "../../components/shared/message";
    import ButtonAction from "../../components/shared/button-action";
    import FormDefault from "../../components/shared/form-default";
    import DivContainer from "../../components/shared/div-container";
    import InputForm from "../../components/shared/input-form";

    export default {
        components: {InputForm, DivContainer, ButtonAction, Message, TagTitle, FormDefault},
        data() {
            return {
                errors: [],
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
                console.log(this.serie);
                this.saving = true
                this.message = false
                api.create(this.serie)
                .then((data) => {
                    // this.message = 'Processando solicitação...';
                    this.$router.push({ name: 'series.index' });
                }).catch((e) => {
                    this.message = e.response.data || 'Processando solicitação...';
                }).then(() => this.saving = false)
            }
        }
    }
</script>

