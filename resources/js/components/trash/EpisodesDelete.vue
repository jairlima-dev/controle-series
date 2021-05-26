<template>

    <div>
        <message v-if="message">{{ message }}</message>
        <errors v-if="errors" :errors="errors"/>
    </div>

</template>

<script>
    import api from "../../api/episodes"
    import Message from "../shared/message";
    import DivContainer from "../shared/div-container";
    import Errors from "../shared/errors";

    export default {
        components: {Errors, Message, DivContainer},

        data() {
            return {
                errors: null,
                message: '',
                id: this.$route.params.id
            }
        },

        created() {
            if (confirm('Confirma Exclusão?')) {
                this.message = 'Efetuando solicitação... Aguarde...'
                api.delete(this.id)
                    .then(response => {
                        this.message = 'Episódio excluido!';
                        setTimeout(() => this.$router.go(-1), 2000);
                    }).catch(error => {
                        this.message = null;
                        this.errors = error.response.data.errors;
                        setTimeout(() => this.$router.go(-1), 4000);
                })

            } else {
                this.$router.go(-1)
            }

        }
    }
</script>
