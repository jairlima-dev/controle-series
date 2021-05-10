<template>

    <message v-if="message" :text="message"/>

</template>

<script>

    import api from '../../api/series';
    import Message from "../../components/shared/message";

    export default {
        components: {Message},
        data () {

            return {
                id: '',
                message: ''
            }
        },

        created() {
            if (confirm('Confirma Exclusão?')) {
                this.message = 'Efetuando solicitação. Aguarde...';
                api.delete(this.$route.params.id)
                    .then((response) => {
                        this.message = 'Série excluida';
                        setTimeout(() => this.message = null , 2000);
                        // this.$router.push({ name: 'series.index'})
                    })
                    .catch((error) => this.message = 'Ocorreu um erro na solicitação!')
            }

            setTimeout(() => this.message = null , 2000);
            this.$router.push({ name: 'series.index'});

        },
    }

</script>
