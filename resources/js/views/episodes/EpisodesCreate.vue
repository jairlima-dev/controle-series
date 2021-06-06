<template>

    <div-container>
        <tag-title>Novo Episódio</tag-title>
        <message v-if="message">{{ message }}</message>
        <errors-default v-if="error" :error="error"/>

        <form class="flex items-end">

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
    import InputForm from "../../components/shared/input-form";
    import ErrorsDefault from "../../components/shared/errors-default";

    export default {
        components: {ErrorsDefault, InputForm, ButtonAction, TagTitle, DivContainer, Message},

        data () {
            return {
                error: null,
                message: '',
                episodios: {
                    nome: '',
                    temporada_id: this.$route.params.id
                }
            }
        },

        methods: {
            onSubmit() {
                api.create(this.episodios)
                    .then(() => {
                        this.$router.go(-1);
                    }).catch((error) => {
                        this.error = error.response.data.errors;
                    });
            }
        }
    }
</script>
