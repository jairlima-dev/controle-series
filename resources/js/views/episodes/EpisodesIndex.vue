<template>

    <div-container>
        <tag-title>Série: {{ nomeTemporada }} - Temporada {{ numeroTemporada }} </tag-title>
        <message v-if="message">{{ message }}</message>
        <errors-default v-if="error" :error="error"/>

        <div-actions>
            <div  class="flex flex-1 justify-between">

                <div  class="flex">
                    <button-link to="episodes.create"
                            :id="idTemporada"
                            :numero="numeroTemporada"
                            tag="Episódio"
                            type="add"/>
                    <input-form size="lg" label-text="Filtrar: " display="inline" v-model="filter"/>
                    
                </div>

                <button-action type="save" :tag="assistir ? 'Assistindo' : 'Assistir'" @execute="watchEpisodes"/>                

            </div>

        </div-actions>

        <ul v-for="episodio in filteredEpisodes" :key="episodio.id" class="flex flex-col">

            <div v-if="showOnEdit === episodio.id" class="flex p-2 border-2 rounded-md intems-center">
                <div class="mt-3">
                    Episódio {{ episodio.numero }}
                </div>

                <input-form size="lg" v-model="episodio.nome"/>
                <button-action type="save" @execute="editName(episodio)"/>
                <button-action type="cancel" @execute="onEdit()"/>
            </div>

            <li v-if="!showOnEdit" class="flex p-2 border-2 justify-between rounded-md intems-center">

                <div class="title flex-1 p-2 text-xl" >
                    Episódio {{ episodio.numero }} - {{ episodio.nome }} 
                </div>

                <div  class="action-buttons flex flex-invert">

                    <button-action type="edit" @execute="onEdit(episodio.id)"/>
                    <button-action type="delete" @execute="deleteEpisode(episodio.id)" :confirmation="true"/>
                    <checkbox-default 
                        :label="episodio.assistido ? 'Assistido' : 'Assistir'" 
                        @change="watch(episodio)" 
                        v-model="episodio.assistido"
                    />

                </div>
            </li>
        </ul>

        <pagination-default v-show="!showOnEdit" :source="pagination" @navigate="navigate"/>

    </div-container>

</template>

<script>

    import api from '../../api/episodes';
    import global from '../../api/global';

    import TagTitle from "../../components/shared/tag-title";
    import Message from "../../components/shared/message";
    import ButtonLink from "../../components/shared/button-link";
    import DivContainer from "../../components/shared/div-container";
    import DivActions from "../../components/shared/div-actions";
    import FilterDefault from "../../components/trash/input-filter";
    import ButtonAction from "../../components/shared/button-action";
    import InputForm from "../../components/shared/input-form";
    import PaginationDefault from "../../components/shared/pagination-default";
    import ErrorsDefault from "../../components/shared/errors-default";
    import { refresh } from "../../utils";
    import CheckboxDefault from '../../components/shared/checkbox-default.vue';

    export default {

        components: {
            ErrorsDefault,
            PaginationDefault,
            InputForm, ButtonAction, DivContainer, DivActions,
            FilterDefault, Message, TagTitle, ButtonLink, CheckboxDefault},

        data () {
            return {
                filter: '',
                error: null,
                idTemporada: this.$route.params.id,
                numeroTemporada: this.$route.params.numero,
                nomeTemporada: this.$route.params.nome,
                hideOnEdit: true,
                showOnEdit: false,
                message: '',
                episodios: null,
                pagination: null, 
                assistir: false,  
                error: '', 
                message: '',     
                assistido: []           
            }
        },

        mixins: [refresh],

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
                api.all(this.idTemporada)
                    .then(response => {
                        this.episodios = response.data.data;
                        this.pagination = response.data;
                        this.mountWatched();
                    }).catch(error => {
                        this.error = error.response.data.errors
                    })
            },

            mountWatched() {
                this.episodios.forEach(element => {
                    if (element.assistido) {
                        this.assistido.push(element.id)
                    }
                });
            },

            watch(episode) {               
                var index = this.assistido.indexOf(episode.id) 
                if(index === -1) this.assistido.push(episode.id)
                else this.assistido.splice(index, 1)                    
            },

            watchEpisodes() {
                this.assistir = true
                api.watch(this.idTemporada, { assistidos: this.assistido })
                    .then(() => {
                        this.assistido = [];
                        this.fetchData()
                        this.assistir = false;
                        this.message = 'Episódios marcados com sucesso!';
                        setTimeout(() => this.message = null, 3000)
                    })
                    .catch(error => {
                        this.error = error.response.data.errors
                    })
            },

            onEdit(idEpisode) {
                this.showOnEdit = idEpisode;
                this.message = this.error = null;
                if (!this.hideOnEdit) {
                    this.hideOnEdit = true;
                } else {
                    this.hideOnEdit = false;
                }
            },

            editName(episodio) {
                api.update(episodio.id, {nome: episodio.nome})
                    .then(response => {
                        this.onEdit();
                        this.message = `Episódio ${episodio.numero}: ${episodio.nome} Alterado`
                        setTimeout(() => this.message = null, 3000);
                    }).catch(error => {
                        this.error = error.response.data.errors;
                        setTimeout(() => this.error = null, 2000)
                })
            },

            deleteEpisode(id) {
                this.message = 'Efetuando solicitação... Aguarde...'
                api.delete(id)
                    .then(response => {
                        this.message = 'Episódio excluido!';
                        setTimeout(() => this.refresh(), 2000);
                    }).catch(error => {
                        this.message = null;
                        this.error = error.response.data.errors;
                        setTimeout(() => this.error = null, 3000);
                })
            }, 

            navigate(page) {
                global.paginate(page)
                    .then(response => {
                        this.episodios = response.data.data;
                        this.pagination = response.data;
                    })
                    .catch(error => {
                        this.error = error.response.data.errors
                    })
            },
        },

    }

</script>
