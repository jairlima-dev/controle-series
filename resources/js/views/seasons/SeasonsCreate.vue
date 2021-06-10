<template>

    <div-container>
        <tag-title>Nova Temporada</tag-title>
        <message v-if="message">{{ message }}</message>
        <errors-default v-if="error" :error="error"/>

        <form class="flex items-end" @submit.prevent="onSubmit($event)">

            <input-form size="sm" rules="required|max:2|num" v-model="temporadas.episodios" label-text="Episódios"/>
            <button-action v-if="temporadas.episodios" type="save" @execute="onSubmit" tag="Salvar"/>
            <button-action v-else type="disabled" tag="Salvar"/>

        </form>

    </div-container>

</template>

<script>
    import api from "../../api/seasons"
    import { checkToken } from "../../utils";

    import Message from "../../components/shared/message";
    import TagTitle from "../../components/shared/tag-title";
    import ButtonAction from "../../components/shared/button-action"
    import DivContainer from "../../components/shared/div-container";
    import InputForm from "../../components/shared/input-form"
    import ErrorsDefault from "../../components/shared/errors-default";

    export default {
        components: {ErrorsDefault, DivContainer, InputForm, TagTitle, ButtonAction, Message},

        data() {

          return {
              error: null,
              message: '',
              temporadas: {
                  episodios: null,
                  serie_id: this.$route.params.id
              }
          }
        },

        mixins: [checkToken],

        methods: {
            onSubmit() {
                api.create(this.temporadas)
                    .then(() => {
                        this.$router.go(-1);
                    }).catch(errors => {
                        this.error = errors.response.data.errors;
                });

            }
        }

    }
</script>
