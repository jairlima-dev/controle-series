<template>

    <div-container>
        <tag-title title="Inserir Nome"/>
        <message v-if="message" :text="message"/>

        <form class="flex items-end" @submit.prevent="onSubmit($event)">

            <div>
                <label class="block" for="name">Episódio</label>
                <input class="w-96 px-2 py-1 border rounded-md block" id="name"
                       v-model="episodio.nome"/>
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
                    nome: ''
                }
            }
        },

        created () {
            api.find(this.$route.params.id).
            then((response) => {
                this.episodio = response.data.data;
            })
            .catch(error => {
                this.message = "Erro no processamento dos dados!";
            });

        },

        methods: {
            onSubmit($event) {
                api.update(this.episodio.id, {
                    nome: this.episodio.nome
                }).then(data => {
                    this.$router.go(-1);
                }).catch(error => {
                    this.message = 'Erro ao processar os dados!';
                })
            }
        }
    }
</script>
