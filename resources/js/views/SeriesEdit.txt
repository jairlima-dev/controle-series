<template>

    <div-container>

        <tag-title title="Alterar Série"/>

        <message v-if="message" :text="message"/>

        <form class="flex items-end" @submit.prevent="onSubmit($event)">

            <div>
                <label class="block" for="serie_name">Série</label>
                <input class="w-96 px-2 py-1 border rounded-md block" id="serie_name"
                       v-model="serie.nome"/>
            </div>

            <button-action save="true" tag="Salvar"/>

        </form>

    </div-container>

</template>

<script>

    import api from '../../api/series';
    import Message from "../../components/shared/message";
    import TagTitle from "../../components/shared/tag-title";
    import ButtonAction from "../../components/shared/button-action"
    import FormDefault from "../../components/shared/form-default";
    import DivContainer from "../../components/shared/div-container";

    export default {
        components: {DivContainer, FormDefault, TagTitle, Message, ButtonAction},

        data() {
            return {
                message: null,
                loaded: false,
                saving: false,
                serie: {
                    id: null,
                    nome: '',
                    temporadas: null
                },

            }
        },

        created() {
            api.find(this.$route.params.id).
            then((response) => {
                console.log(response);
                // this.loaded = true;
                this.serie = response.data.data;
            }).catch(error => {
                this.$router.push({ name: '404'});
            });
        },

        methods: {
            onSubmit(event) {
                api.update(this.serie.id, {
                    nome: this.serie.nome
                }).then((response) => {
                    this.message = 'Série Alterada';
                    setTimeout(() => this.message = null, 2000);
                    this.serie = response.data.data;
                }).catch(error => {
                    console.log(error);
                }).then(_ => this.saving = false);

            },

        },

    }

</script>
