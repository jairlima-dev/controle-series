<template>

    <div-container>
        <tag-title title="Episódios"/>
        <message v-if="message" :text="message"/>

        <div-actions class="justify-between">

            <div class="flex">
                <button-link to="episodes.create" :id="id" tag="Novo Episódio" add="true"/>
                <filter-default/>
            </div>

            <button-action tag="Salvar" save="true"/>

        </div-actions>

        <ul id="assisted" class="flex flex-col" v-if="episodios">

            <li class="flex p-2 border-2 justify-between intems-center"
                v-for="{ id, numero, nome, assistido } in episodios" :key="id">

                <div class="flex items-center" >

                    <div class="title flex flex-1 p-2 text-xl">
                        Episódio {{ numero }} - {{ nome }}
                    </div>

                </div>

                <div class="action-buttons flex flex-invert">

                    <button-link to="episodes.edit" :id="id" edit="true"/>
                    <button-link to="episodes.delete" :id="id" del="true"/>

                    <div class="ml-4 text-center text-xl">

                        <label for="assistir" class="block">Assistido - {{ assistido }} - {{ id }}</label>
                        <input type="checkbox" :name="id" id="assistir">

                    </div>

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

    export default {

        components: {ButtonAction, DivContainer, DivActions, FilterDefault,
                    Message, TagTitle, ButtonLink},

        data () {
            return {
                message: '',
                id: null,
                episodios: null
            }
        },

        created() {
            this.fetchData();
        },

        beforeUpdate() {
            // this.episodios.forEach(this.checkAssistido())
            this.checkAssistido()
        },

        methods: {
            fetchData() {
                api.all(this.$route.params.id)
                    .then(response => {
                        this.episodios = response.data.data;
                        this.id = this.episodios[0].temporada_id;
                    }).catch(error => this.message = 'Erro na busca!');
            },

            checkAssistido() {
                    let i = 0;
                    for (i = 0; i < this.episodios.length; i++) {
                        if (this.episodios[i].assistido == true) {
                            console.log('Pra checar!');
                            // let idEpisodio = this.episodios[i].id;
                            let ver = document.getElementById("assisted");
                            console.log(ver);
                            let idCheck = ver.document.getElementsByTagName('input');


                        } else if (this.episodios[i].assistido == false) {
                            console.log('Em branco!')
                            // let idEpisodio = this.episodios[i].id;
                            // console.log(idEpisodio);
                            // document.getElementById('assistido').checked = false;
                        }
                    }
            },

        },

    }

</script>
