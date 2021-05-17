<template>

    <div-container>
<!--        <tag-title title="Novo Episódio"/>-->
        <message v-if="message" :text="message"/>

<!--        <form class="flex items-end" @submit.prevent="onSubmit($event)">-->

<!--            <div>-->
<!--                <label class="block" for="episode_name">Nome do Episódio</label>-->
<!--                <input class="w-96 px-2 py-1 border rounded-md block"-->
<!--                       id="episode_name" v-model="episodios.nome"/>-->
<!--            </div>-->

<!--            <button-action save="true" tag="Salvar"/>-->

<!--        </form>-->

    </div-container>

</template>

<script>
    import api from "../../api/episodes"
    import DivContainer from "../../components/shared/div-container";
    // import TagTitle from "../../components/shared/tag-title";
    import Message from "../../components/shared/message";
    // import ButtonAction from "../../components/shared/button-action"

    export default {
        components: {DivContainer, Message},

        data () {
            return {
                message: '',
                episodios: {
                    // nome: "",
                    temporada_id: this.$route.params.id
                }
            }
        },

        created() {
            api.create(this.episodios)
                .then(data => {
                    this.message = 'Criado episódio: ';
                    setTimeout(() => this.$router.go(-1), 3000);
                    // this.$router.go(-1);
                }).catch(error => {
                this.message = 'Erro ao carregar os dados!'
            });
        },

        // methods: {
        //     onSubmit($event) {
        //         api.create(this.episodios)
        //             .then(data => {
        //             this.$router.go(-1);
        //             }).catch(error => {
        //                 this.message = 'Erro ao carregar os dados!'
        //             });
        //     }
        // }
    }
</script>

<style scoped>

</style>
