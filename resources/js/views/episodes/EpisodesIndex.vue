<template>

    <div  class="border-2 px-4 py-2 rounded-md">

        <tag-title title="Episódios"/>

        <message v-if="message" :text="message"/>

    </div>


</template>

<script>

    import api from '../../api/episodes';
    import TagTitle from "../../components/shared/tag-title";
    import Message from "../../components/shared/message";

    export default {

        components: {Message, TagTitle},

        data () {
            return {
                id: null,
                numero: null,
                message: '',
                episodios: null
            }
        },

        created() {
            this.fetchData();
        },

        methods: {
            fetchData() {
                api.all(this.$route.params.id)
                    .then(response => {
                        console.log(response);
                    }).catch(error => this.message = 'Erro na busca!');
            }

        }


    }
</script>
