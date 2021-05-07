<template>

    <div  class="border-2 px-4 py-2 rounded-md">

        <tag-title title="Episódios"/>

        <message v-if="message" :text="message"/>

        <ul class="flex flex-col" v-if="episodios">

            <li class="flex p-2 border-2 justify-between intems-center" v-for="{ id, numero } in episodios">

                <div class="flex">

                    <div class="title flex flex-1 p-2 text-xl">
                        Episódio - {{ numero }}
                    </div>

                    <div class="action-buttons flex">
                        <button-action edit="true"/>
                    </div>

                </div>


                <div class="action-buttons flex flex-invert">

                    <div class="text-center text-xl">

                        <label class="block" for="assistido">Assistido</label>
                        <input type="checkbox" id="assistido">

                    </div>

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
    import ButtonAction from "../../components/shared/button-action";

    export default {

        components: {ButtonAction, Message, TagTitle, ButtonLink},

        data () {
            return {
                message: '',
                onEdit: false,
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
                        this.episodios = response.data.data
                    }).catch(error => this.message = 'Erro na busca!');
            }

        }


    }
</script>
