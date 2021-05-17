<template>

    <div-container>
        <tag-title title="Nova Temporada"/>
        <message v-if="message" :text="message"/>

        <form class="flex items-end" @submit.prevent="onSubmit($event)">

            <input-form sm="sm" v-model="temporadas.episodios"label-text="Episódios" ></input-form>
            <button-action save="true" tag="Salvar"/>

        </form>

    </div-container>

</template>

<script>
    import api from "../../api/seasons"
    import Message from "../../components/shared/message";
    import TagTitle from "../../components/shared/tag-title";
    import ButtonAction from "../../components/shared/button-action"
    import DivContainer from "../../components/shared/div-container";
    import InputForm from "../../components/shared/input-form"

    export default {
        components: {DivContainer, InputForm, TagTitle, ButtonAction, Message},

        data() {

          return {
              message: '',
              temporadas: {
                  episodios: null,
                  serie_id: this.$route.params.id
              }
          }
        },

        methods: {
            onSubmit($event) {
                console.log(this.temporadas);
                api.create(this.temporadas)
                    .then(data => {
                        this.$router.go(-1);
                    }).catch(errors => {
                        this.message = errors.response.data || 'Erro! Verifique ';
                });

            }
        }


    }
</script>
