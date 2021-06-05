<template>

    <div>
        <message v-if="message">{{ message }}</message>
        <errors v-if="errors" :errors="errors"/>
    </div>

</template>

<script>
    import api from "../../api/episodes";
    import Message from "../shared/message";
    import DivContainer from "../shared/div-container";
    import Errors from "../shared/errors-default";

    export default {
        components: {Errors, Message, DivContainer},

        props: {
          data: String
        },

        data() {
            return {
                errors: null,
                message: '',
                id: this.$route.params.id,
                nome: this.$route.params.nome,
            }
        },

        created() {
            api.update(this.id, {nome: this.nome,})
                .then(response => {
                this.message = `Episódio Alterado: ${this.nome}`;
                setTimeout(() => this.$router.go(-1), 2000)
            }).catch(error => {
                this.errors = error.response.data.errors;
                setTimeout(() => this.$router.go(-1), 2000)
            })
        },

    }
</script>
