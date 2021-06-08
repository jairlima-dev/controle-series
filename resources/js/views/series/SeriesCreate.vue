<template>
    <div-container>
        <tag-title>Nova Série</tag-title>
        <message v-if="message">{{ message }}</message>
        <errors-default v-if="error" :error="error"/>

        <form class="flex items-end">

            <input-form size="lg" v-model="serie.nome" rules="required|min:3" label-text="Nome" input-id="nome"/>
            <input-form size="sm" v-model="serie.temporadas" rules="required" label-text="Temporadas" input-id="nome"/>
            <input-form size="sm" v-model="serie.episodios" rules="required" label-text="Episodios" input-id="nome"/>

            <button-action v-if="serie.nome && serie.temporadas && serie.episodios"
                           type="save" tag="Salvar" @execute="submit"/>
            <button-action v-else
                           type="disabled" tag="Salvar"/>

        </form>

    </div-container>
</template>

<script>

    import api from '../../api/series';
    import { verifyToken } from "../../utils"

    import TagTitle from "../../components/shared/tag-title";
    import Message from "../../components/shared/message";
    import ButtonAction from "../../components/shared/button-action";
    import FormDefault from "../../components/shared/form-default";
    import DivContainer from "../../components/shared/div-container";
    import InputForm from "../../components/shared/input-form";
    import ErrorsDefault from "../../components/shared/errors-default";

    export default {

        components: {ErrorsDefault, InputForm, DivContainer, ButtonAction, Message, TagTitle, FormDefault},

        data() {
            return {
                error: null,
                message: null,
                serie: {
                    nome: '',
                    temporadas: null,
                    episodios: null
                }
            }
        },

        mixins: [verifyToken],

        methods: {
            submit() {
                api.create(this.serie)
                .then(() => {
                    this.error = null;
                    this.message = 'Processando solicitação...';
                    this.$router.push({ name: 'series.index' });
                }).catch((error) => {
                    this.error = error.response.data.errors;
                })
            }
        }
    }

</script>

