<template>

    <div-container>
        <tag-title title="Nova Série"/>
        <message v-if="message" :text="message"/>

        <form class="flex items-end" @submit.prevent="onSubmit($event)">

            <input-form lg="lg" v-model="serie.nome" label-text="Nome" input-id="nome"/>
            <input-form sm="sm" v-model="serie.temporadas" label-text="Temporadas" input-id="nome"/>
            <input-form sm="sm" v-model="serie.episodios" label-text="Episodios" input-id="nome"/>

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
                    this.message = 'Processando solicitação...';
                    this.$router.push({ name: 'series.index' });
                }).catch((e) => {
                    this.message = 'É necessário preencher todos os campos obrigatórios!'
                        || e.response.data
                        || 'Processando solicitação...';
                }).then(() => this.saving = false)
            }
        }
    }
</script>

