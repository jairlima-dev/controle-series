<template>

    <div-container>
        <message v-if="message">{{ message }}</message>
        <errors v-if="errors" :errors="errors"/>
    </div-container>

</template>

<script>

    import api from '../../api/series';
    import Errors from "../shared/errors";
    import Message from "../shared/message";
    import DivContainer from "../shared/div-container";

    export default {
        components: {DivContainer, Errors, Message},
        data () {

            return {
                errors: null,
                // id: '',
                message: ''
            }
        },

        created() {
            if (confirm('Confirma Exclusão?')) {
                this.message = 'Efetuando solicitação. Aguarde...';
                api.delete(this.$route.params.id)
                    .then((response) => {
                        this.message = 'Série excluida'
                        // setTimeout(() => this.message = null ,4000);
                        this.$router.push({ name: 'series.index'});
                        })
                    .catch((error) => this.message = 'Ocorreu um erro na solicitação!')
            } else {
                this.$router.push({ name: 'series.index'})
            }
            // setTimeout(() => this.$router.push({ name: 'series.index'}), 2000);


        },
    }

</script>
