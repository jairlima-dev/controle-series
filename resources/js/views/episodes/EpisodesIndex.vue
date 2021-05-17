<template>

    <div-container>
        <tag-title title="Episódios"/>
        <message v-if="message" :text="message"/>

        <div-actions class="justify-between">

            <div class="flex">
                <button-link to="episodes.create" :id="id" tag="Episódio" add="true"/>
                <filter-default/>
            </div>

            <button-action tag="Assistidos" save="true"/>

        </div-actions>

        <ul class="flex flex-col" v-if="episodios">

            <li class="flex p-2 border-2 justify-between rounded-md intems-center"
                v-for="episodio in episodios" :key="episodio.id">

                <div class="title flex-1 p-2 text-xl" >

                    <div v-if="!edit">
                        Episódio {{ episodio.numero }} - {{ episodio.nome }}
                    </div>

                    <div v-else-if="episodeId === episodio.id" class="flex items-center">
                        Episódio {{ episodio.numero }} -
                        <input class="w-96 px-2 py-1 mr-2 border rounded-md "
                               type="text" v-model="episodio.nome">
                        <button-link save="true" to="episodes.edit" :id="episodio.id" :data="episodio.nome"/>
                    </div>

                </div>

                <div class="action-buttons flex flex-invert">

                    <button @click="onEdit(episodio.id)" class="border-4 border-yellow-300 hover:border-yellow-600
                            text-yellow-400 font-bold text-xl h-12 py-2 px-3 mr-2 rounded-md">
                        <i class="fas fa-pen"/></button>

                    <button-link to="episodes.delete" :id="episodio.id" del="true"/>



                    <checked-default labelText="Assistido - " v-model="episodio.assistido"></checked-default>
                    {{ episodio.assistido}}


                    <!--                    <div class="ml-4 text-center text-xl">-->
<!--                        <label for="assistido" class="block">Assistido - {{ episodio.assistido }}</label>-->
<!--                        <input type="checkbox" id="assistido" v-model="episodio.assistido">-->

<!--                    </div>-->

                </div>

            </li>

        </ul>

    </div-container>

</template>

<script>

    import api from '../../api/episodes';
    import TagTitle from "../../components/shared/tag-title";
    import Message from "../../components/shared/message";
    import ButtonLink from "../../components/shared/button-link";
    import DivContainer from "../../components/shared/div-container";
    import DivActions from "../../components/shared/div-actions";
    import FilterDefault from "../../components/shared/filter-default";
    import ButtonAction from "../../components/shared/button-action";
    import CheckedDefault from "../../components/shared/checked-default"

    export default {

        components: {ButtonAction, CheckedDefault, DivContainer, DivActions, FilterDefault,
                    Message, TagTitle, ButtonLink},

        data () {
            return {
                edit: false,
                episodeId: false,
                message: '',
                id: this.$route.params.id,
                episodios: null,
            }
        },

        created() {
            this.fetchData();
        },

        methods: {
            fetchData() {
                api.all(this.$route.params.id)
                    .then(response => {
                        this.episodios = response.data.data;
                        this.id = this.episodios[0].temporada_id;
                    }).catch(error => this.message = 'Erro na busca!');
            },

            onEdit(idEpisode) {
                this.episodeId = idEpisode;
                if (!this.edit) {
                    this.edit = true;
                } else {
                    this.edit = false;
                }
            }

        },

    }

</script>
