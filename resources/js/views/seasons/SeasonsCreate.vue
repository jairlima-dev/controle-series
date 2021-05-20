<template>

    <div-container>
        <tag-title>Nova Temporada</tag-title>
        <message v-if="message">{{ message }}</message>
        <errors v-if="errors" :errors="errors"/>

<!--        <form class="flex items-end" @submit.prevent="onSubmit($event)">-->
        <form class="flex items-end" @submit.prevent="onSubmit($event)">

            <input-form size="sm" v-model="temporadas.episodios" label-text="Episódios"/>
            <button-action type="save" @execute="onSubmit" tag="Salvar"/>

        </form>

    </div-container>

</template>

<script>
    import api from "../../api/seasons"
    import Errors from "../../components/shared/errors";
    import Message from "../../components/shared/message";
    import TagTitle from "../../components/shared/tag-title";
    import ButtonAction from "../../components/shared/button-action"
    import DivContainer from "../../components/shared/div-container";
    import InputForm from "../../components/shared/input-form"

    export default {
        components: {DivContainer, Errors, InputForm, TagTitle, ButtonAction, Message},

        data() {

          return {
              errors: null,
              message: '',
              temporadas: {
                  episodios: null,
                  serie_id: this.$route.params.id
              }
          }
        },

        methods: {
            onSubmit($event) {
                api.create(this.temporadas)
                    .then(data => {
                        this.$router.go(-1);
                    }).catch(errors => {
                        this.errors = errors.response.data.errors;
                });

            }
        }


    }
</script>
