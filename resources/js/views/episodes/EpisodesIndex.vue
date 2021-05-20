<template>

    <div-container>
        <tag-title>Série: {{ nomeTemporada }} - Temporada {{ numeroTemporada }} </tag-title>
        <message v-if="message">{{ message }}</message>
        <errors v-if="errors" :errors="errors"/>

        <div-actions>
            <button-link to="episodes.create"
                         :id="id"
                         :numero="numeroTemporada"
                         tag="Episódio"
                         type="add"/>

            <div class="flex items-center">
                <label for="filtro">Filtrar: </label>
                <input id="filtro"
                       type="search"
                       @input="filter = $event.target.value"
                       class="w-96 mx-2 p-2 border-2"
                       label-text="Buscar"
                       placeholder="Digite aqui a sua busca">
            </div>

        </div-actions>

        <ul v-if="episodios" v-for="episodio in filteredEpisodes" :key="episodio.id" class="flex flex-col">

            <li class="flex p-2 border-2 justify-between rounded-md intems-center">

                <div class="title flex-1 p-2 text-xl" >

                    <div v-if="!editNome">
                        Episódio {{ episodio.numero }} - {{ episodio.nome }}
                    </div>

                    <div v-else-if="episodeId === episodio.id" class="flex items-center">
                        Episódio {{ episodio.numero }} -
                        <input class="w-96 px-2 py-1 mr-2 border rounded-md "
                               type="text" v-model="episodio.nome">
                        <button-link to="episodes.edit"
                                     :id="episodio.id"
                                     :nome="episodio.nome"
                                     type="save"/>
                        <button-action type="cancel" @execute="onEdit()"/>
                    </div>

                </div>

                <div  v-if="!editNome" class="action-buttons flex flex-invert">

                    <button-action type="edit" @execute="onEdit(episodio.id)"/>
                    <button-link type="delete" to="episodes.delete" :id="episodio.id"/>
                    <checked-default :id="episodio.id" labelText="Assistido"
                                     v-model="episodio.assistido"/>

                </div>

            </li>

        </ul>

    </div-container>

</template>

<script>

    import api from '../../api/episodes';
    import TagTitle from "../../components/shared/tag-title";
    import Errors from "../../components/shared/errors";
    import Message from "../../components/shared/message";
    import ButtonLink from "../../components/shared/button-link";
    import DivContainer from "../../components/shared/div-container";
    import DivActions from "../../components/shared/div-actions";
    import FilterDefault from "../../components/shared/input-filter";
    import ButtonAction from "../../components/shared/button-action";
    import CheckedDefault from "../../components/shared/checked-default"

    export default {

        components: {ButtonAction, Errors, CheckedDefault, DivContainer, DivActions,
            FilterDefault, Message, TagTitle, ButtonLink},

        data () {
            return {
                filter: '',
                errors: null,
                numeroTemporada: this.$route.params.numero,
                nomeTemporada: this.$route.params.nome,
                editNome: false,
                episodeId: false,
                message: '',
                id: this.$route.params.id,
                episodios: null,
            }
        },

        created() {
            this.fetchData();
        },

        computed: {
            filteredEpisodes () {
                if (this.filter) {
                    let exp = new RegExp(this.filter.trim(), 'i');
                    return this.episodios.filter(episodio => exp.test(episodio.nome));
                } else {
                    return this.episodios;
                }
            },
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
                if (!this.editNome) {
                    this.editNome = true;
                } else {
                    this.editNome = false;
                }
            }
        },

    }

</script>
