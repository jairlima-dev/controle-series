<template xmlns="http://www.w3.org/1999/html">
    <div-container>
        <tag-title v-if="currentUser">Profile: {{ currentUser.name }}</tag-title>

        <form-default class="text-2xl mx-6 my-12">
            Usuário: {{ currentUser.name }} <br>
            E-mail: {{ currentUser.email }} <br>
        </form-default>
    </div-container>
</template>

<script>
    import DivContainer from "../../components/shared/div-container";
    import TagTitle from "../../components/shared/tag-title";
    import FormDefault from "../../components/shared/form-default";

    export default {
        name: "About",
        components: {FormDefault, TagTitle, DivContainer},

        computed: {
            currentUser() {
                if (this.$store.state.token) {
                    return this.$store.state.user
                }
            }
        }
    }
</script>
