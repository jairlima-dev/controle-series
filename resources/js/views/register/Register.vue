<template>

    <div-container>
        <tag-title>Cadastrar Usuário</tag-title>
        <message v-if="message">{{ message }}</message>
        <errors-default v-if="error" :error="error"/>

        <form class="flex items-end">

            <input-form size="md" v-model="user.name" rules="required|min:3" label-text="Nome" input-id="nome"/>
            <input-form size="lg" v-model="user.email" rules="required|email" label-text="E-mail" input-id="email"/>
<!--            <input-form size="md" type="password" v-model="user.password" rules="required|min:6|confirmed:pass" label-text="Senha" input-id="password"/>-->
            <input-form size="md" type="password" v-model="user.password" rules="required|min:6" label-text="Senha" input-id="password"/>
            <input-form size="md" type="password" v-model="user.c_password" rules="required|min:6" label-text="Redigite a Senha" input-id="c_password"/>

            <button-action  type="save" tag="Salvar" @execute="submit"/>

        </form>

    </div-container>

</template>

<script>
    import users from "../../api/users";
    import { verifyToken } from "../../utils";
    import DivContainer from "../../components/shared/div-container";
    import TagTitle from "../../components/shared/tag-title";
    import Message from "../../components/shared/message";
    import ErrorsDefault from "../../components/shared/errors-default";
    import InputForm from "../../components/shared/input-form";
    import ButtonAction from "../../components/shared/button-action";

    export default {
        name: "Register",
        components: {ButtonAction, InputForm, ErrorsDefault, Message, TagTitle, DivContainer},

        data() {
            return {
                user: {
                    name: '',
                    email: '',
                    password: '',
                    c_password: '',
                },
                message: '',
                error: '',
            }
        },

        mixins: [verifyToken],

        methods: {
            submit() {
                users.create(this.user)
                    .then(response => {
                        this.error = null;
                        // let newUser = response
                        this.message = `Usuário "${this.user.name}" registrado com sucesso!`;
                        setTimeout(() => this.$router.push({ name: 'series.index' }), 3000)
                        // this.$router.push({ name: 'series.index' });
                    }).catch(error => {
                        this.error = error.response.data.errors
                    }

                )
            }


        },

    }



</script>

<style scoped>

</style>
