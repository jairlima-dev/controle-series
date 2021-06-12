<template>

    <div-container>
        <tag-title>Cadastrar Usuário</tag-title>
        <message v-if="message">{{ message }}</message>
        <errors-default v-if="error" :error="error"/>

        <form-default class="flex items-end">

             <input-form v-model="user.name"
                         rules="required|min:4"
                         size="md"
                         label-text="Nome"
                        input-id="nome"/>
            <input-form v-model="user.email"
                        rules="required|email"
                        size="lg"
                        label-text="E-mail"
                        input-id="email"/>
            <input-form v-model="user.password"
                        rules="required|min:6"
                        size="md"
                        type="password"
                        label-text="Senha"
                        input-id="password"/>
            <input-form v-model="user.c_password"
                        rules="required"
                        type="password" size="md"
                        label-text="Redigite a Senha"
                        input-id="c_password"/>

            <button-action v-if="user.name && user.email && user.password && user.c_password"
                           type="save" tag="Salvar" @execute="submit"/>
            <button-action v-else type="disabled" tag="Salvar"/>

        </form-default>

        <ul v-if="users" v-for="user in users" :key="user.id" class="flex flex-col">

            <li class="flex p-2 border-2 justify-between rounded-md items-center">

                <div class="title flex-1 p-2 text-xl" >
                    {{ user.name }} - {{ user.email }}
                </div>

                <div class="action-buttons flex flex-invert">
                    <button-action type="delete"
                                   @execute="deleteUser(user)"
                                   :confirmation="true"/>
                </div>

            </li>
        </ul>

        <pagination-default :source="pagination" @navigate="navigate"></pagination-default>

    </div-container>

</template>

<script>
    import api from "../../api/users";
    import { checkToken, refresh } from "../../utils";
    import DivContainer from "../../components/shared/div-container";
    import TagTitle from "../../components/shared/tag-title";
    import Message from "../../components/shared/message";
    import ErrorsDefault from "../../components/shared/errors-default";
    import InputForm from "../../components/shared/input-form";
    import ButtonAction from "../../components/shared/button-action";
    import FormDefault from "../../components/shared/form-default";
    import ButtonLink from "../../components/shared/button-link";
    import global from "../../api/global";
    import PaginationDefault from "../../components/shared/pagination-default";

    export default {
        name: "Register",
        components: {
            PaginationDefault, ButtonLink, FormDefault, ButtonAction, InputForm,
            ErrorsDefault, Message, TagTitle, DivContainer},

        data() {
            return {
                user: {
                    name: '',
                    email: '',
                    password: '',
                    c_password: '',
                },
                users: null,
                showOnEdit: false,
                message: '',
                error: '',
                pagination: null,
            }
        },

        mixins: [refresh],

        created() {
            this.fetchData()
        },

        methods: {
            fetchData() {
                api.all()
                    .then(response => {
                        this.users = response.data.data;
                        this.pagination = response.data;
                    }).catch((error) => {
                    this.error = error.response.data.errors;
                })
            },

            submit() {
                api.create(this.user)
                    .then(response => {
                        this.refresh();
                        this.message = `Usuário "${this.user.name}" registrado com sucesso!`;
                        this.refreshForm();
                        setTimeout(() => this.message = null, 3000);
                    })
                    .catch(error => {
                        this.error = error.response.data.errors
                    })
            },

            deleteUser(user) {
                this.message = 'Efetuando solicitação. Aguarde...';
                api.delete(user.id)
                    .then(response => {
                        this.message = `Usuário "${ user.name }" excluído!`;
                        setTimeout(() => this.refresh(), 3000);
                    })
                    .catch(error => {
                        this.error = error.response.data.errors
                    })
            },

            refreshForm () {
                this.user.name = this.user.email = this.user.password = this.user.c_password = null;
            },

            navigate(page) {
                global.paginate(page)
                    .then(response => {
                        this.users = response.data.data;
                        this.pagination = response.data;
                    })
                    .catch(error => {
                        this.error = error.response.data.errors;
                    })
            },
        },
    }

</script>

<style scoped>

</style>
