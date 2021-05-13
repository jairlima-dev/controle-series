<template>

    <div-container>

        <tag-title title="Alterar Episódio"/>

        <message v-if="message" :text="message"/>

        <form class="flex flex-1 items-end" @submit.prevent="onSubmit($event)">

            <div class="mb-2">
                <strong>Episódio - {{ episodio.numero }}  </strong>
            </div>

            <div class="mx-1 block">
                <label class="block" for="name">Nome</label>
                <input class="w-96 px-2 py-1 border-2 rounded-md" id="name" v-model="episodio.nome" />
            </div>

            <div class="ml-4 text-center text-lg">
                <label class="block" for="assistido">Assistido</label>
                <input type="checkbox" id="assistido" v-on:input="onCheckAssistido">
            </div>

            <button-action save="true" tag="Salvar"/>

        </form>

    </div-container>

</template>

<script>
    import api from "../../api/episodes";
    import DivContainer from "../../components/shared/div-container";
    import TagTitle from "../../components/shared/tag-title";
    import Message from "../../components/shared/message";
    import ButtonAction from "../../components/shared/button-action";

    export default {
        name: "EpisodesEdit",
        components: {Message, ButtonAction, TagTitle, DivContainer},

        data () {
            return {
                message: '',
                episodio: {
                    id: null,
                    numero: '',
                    nome: '',
                    assistido: null

                }
            }
        },

        created () {
            this.fetchData()
        },

        beforeUpdate () {
            this.checkAssistido()
        },

        methods: {
            fetchData () {
                api.find(this.$route.params.id).
                then((response) => {
                    this.episodio = response.data.data;
                })
                    .catch(error => {
                        this.message = "Erro no processamento dos dados!";
                    })
            },

            checkAssistido () {
                let assistido = this.episodio.assistido;
                if (assistido == true) {
                    document.getElementById('assistido').checked = true;
                } else {
                    document.getElementById('assistido').checked = false;
                }
            },

            onCheckAssistido () {
                let checked = document.getElementById('assistido').checked;
                if (checked) {
                    this.episodio.assistido = true
                } else {
                    this.episodio.assistido = false
                }
            },

            onSubmit($event) {
                api.update(this.episodio.id, {
                    nome: this.episodio.nome,
                    assistido: this.episodio.assistido
                }).then(data => {
                    this.$router.go(-1);
                }).catch(error => {
                    this.message = 'Erro ao processar os dados!';
                })
            },
        },

    }
</script>
