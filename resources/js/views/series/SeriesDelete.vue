<template>

    <div v-if="message"
         class="alert red-600 p-2 mb-1 w-50 border-red-100-1 rounded-md bg-red-100 block">
        {{ message }}
    </div>

</template>

<script>

    import api from '../../api/series';

    export default {

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
                        setTimeout(() => this.$router.push({ name: 'series.index'}) , 2000);
                    })
                    .catch((error) => this.message = 'Erro!')
            }

            this.$router.push({ name: 'series.index'})
        },
    }

</script>
