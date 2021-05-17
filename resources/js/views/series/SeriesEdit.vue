<template>

        <message v-if="message" :text="message"/>

</template>

<script>
    import api from '../../api/series';
    import Message from "../../components/shared/message";
    import DivContainer from "../../components/shared/div-container";

    export default {
        components: {DivContainer, Message},

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
            api.update(this.id, {nome: this.nome})
                .then((response) => {
                this.message = `Série Alterada: ${this.nome} `;
                setTimeout(() => this.$router.go(-1), 2000);
            }).catch(error => {
                console.log(error);
                this.message = error;
            }).then(_ => this.saving = false);

        },
    }

</script>
