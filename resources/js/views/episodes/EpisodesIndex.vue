<template>

    <div  class="border-2 px-4 py-2 rounded-md">

        <tag-title title="Episódios"/>

        <message v-if="message" :text="message"/>

        <ul class="flex flex-col" v-if="episodios">

            <li  class="flex p-2 border-2 justify-between" v-for="{ id, numero } in episodios">

                <div class="title flex p-2 text-xl">
                    <div class="flex flex-1 mr-4 mt-2">
                        Episódio - {{ numero }}
                    </div>


                    <button-link blue="true" class="flex w-12 y-12">
                        <i class="fas fa-external-link-alt"/>
                    </button-link>

                </div>

                <div class="action-buttons flex flex-invert">


                    <button-link red="true">
                        <i class="fas fa-trash-alt"/>
                    </button-link>

                </div>

            </li>
        </ul>

    </div>


</template>

<script>

    import api from '../../api/episodes';
    import TagTitle from "../../components/shared/tag-title";
    import Message from "../../components/shared/message";
    import ButtonLink from "../../components/shared/button-link";

    export default {

        components: {Message, TagTitle, ButtonLink},

        data () {
            return {
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
                        this.episodios = response.data.data
                    }).catch(error => this.message = 'Erro na busca!');
            }

        }


    }
</script>
