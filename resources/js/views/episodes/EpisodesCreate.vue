<template>

    <div-container>
        <tag-title>Novo Episódio</tag-title>
        <message v-if="message">{{ message }}</message>
        <errors v-if="errors" :errors="errors"/>

        <form class="flex items-end" @submit.prevent="onSubmit($event)">

            <input-form size="lg" label-text="Nome do Episódio" v-model="episodios.nome"/>
            <button-action type="save" @execute="onSubmit" tag="Salvar"></button-action>

        </form>

    </div-container>

</template>

<script>
    import api from "../../api/episodes"
    import DivContainer from "../../components/shared/div-container";
    import Message from "../../components/shared/message";
    import TagTitle from "../../components/shared/tag-title";
    import ButtonAction from "../../components/shared/button-action";
    import Errors from "../../components/shared/errors";
    import InputForm from "../../components/shared/input-form";

    export default {
        components: {InputForm, Errors, ButtonAction, TagTitle, DivContainer, Message},

        data () {
            return {
                errors: null,
                message: '',
                episodios: {
                    nome: '',
                    temporada_id: this.$route.params.id
                }
            }
        },

        methods: {
            onSubmit($event) {
                api.create(this.episodios)
                    .then(data => {
                        this.errors = null;
                    this.$router.go(-1);
                    }).catch((error) => {
                        this.errors = error.response.data.errors;
                    });
            }
        }
    }
</script>
