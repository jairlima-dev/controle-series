<template>

    <div>
        <message v-if="message">{{ message }}</message>
        <errors v-if="errors" :errors="errors"/>
    </div>

</template>

<script>
    import api from '../../api/series';
    import Message from "../../components/shared/message";
    import DivContainer from "../../components/shared/div-container";
    import Errors from "../../components/shared/errors";

    export default {
        components: {Errors, DivContainer, Message},

        props: {
          dataName: String
        },

        data() {
            return {
                errors: null,
                message: '',
                id: this.$route.params.id,
                nome: this.$route.params.nome,
                // nome: this.dataName,
            }
        },

        created() {
            // console.log(this.dataName)
            api.update(this.id, {nome: this.nome})
                .then((response) => {
                this.message = `Série Alterada: ${this.nome} `;
                setTimeout(() => this.$router.go(-1), 2000);
            }).catch((error) => {
                this.errors = error.response.data.errors;
                setTimeout(() => this.$router.go(-1), 2000);
            }).then(_ => this.saving = false);

        },
    }

</script>
