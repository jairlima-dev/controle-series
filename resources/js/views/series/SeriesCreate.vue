<template>
    <div-container>
        <tag-title>Nova Série</tag-title>
        <message v-if="message">{{ message }}</message>
        <errors v-if="errors" :errors="errors"/>

        <form class="flex items-end">

            <input-form size="lg" v-model="serie.nome" label-text="Nome" input-id="nome"/>
            <input-form size="sm" v-model="serie.temporadas" label-text="Temporadas" input-id="nome"/>
            <input-form size="sm" v-model="serie.episodios" label-text="Episodios" input-id="nome"/>

            <button-action type="save" @execute="submit" tag="Salvar"/>

        </form>

    </div-container>

</template>

<script>

    import api from '../../api/series';
    import TagTitle from "../../components/shared/tag-title";
    import Message from "../../components/shared/message";
    import Errors from "../../components/shared/errors";
    import ButtonAction from "../../components/shared/button-action";
    import FormDefault from "../../components/shared/form-default";
    import DivContainer from "../../components/shared/div-container";
    import InputForm from "../../components/shared/input-form";

    export default {

        components: {InputForm, Errors, DivContainer, ButtonAction, Message, TagTitle, FormDefault},

        data() {
            return {
                errors: null,
                message: null,
                serie: {
                    nome: '',
                    temporadas: null,
                    episodios: null
                }
            }
        },

        methods: {
            submit($event) {
                api.create(this.serie)
                .then((data) => {
                    this.errors = null;
                    this.message = 'Processando solicitação...';
                    this.$router.push({ name: 'series.index' });
                }).catch((error) => {
                    this.errors = error.response.data.errors;
                })
            }
        }
    }

</script>

