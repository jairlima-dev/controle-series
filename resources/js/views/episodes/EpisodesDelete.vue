<template>

        <message v-if="message" :text="message"/>

</template>

<script>
    import api from "../../api/episodes"
    import Message from "../../components/shared/message";
    import DivContainer from "../../components/shared/div-container";

    export default {
        components: {Message, DivContainer},

        data() {
            return {
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
                        this.message = 'Só é possóvel exluir o último episodio!';
                        setTimeout(() => this.$router.go(-1), 3000);
                })

            } else {
                this.$router.go(-1)
            }

        }
    }
</script>
