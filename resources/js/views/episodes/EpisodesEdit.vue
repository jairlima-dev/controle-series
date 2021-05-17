<template>

        <message v-if="message" :text="message"/>

</template>

<script>
    import api from "../../api/episodes";
    import Message from "../../components/shared/message";
    import DivContainer from "../../components/shared/div-container";

    export default {
        components: {Message, DivContainer},

        props: {
          data: String
        },

        data() {
            return {
                message: '',
                id: this.$route.params.id,
                nome: this.$route.params.data,
            }
        },

        created() {
            api.update(this.id, {
                nome: this.nome,
            }).then(data => {
                this.message = `Episódio Alterado: ${this.nome}`;
                setTimeout(() => this.$router.go(-1), 2000)
            }).catch(error => {
                this.message = 'Erro ao processar os dados!';
            })
        },

    }
</script>
