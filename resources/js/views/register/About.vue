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
    import { mapGetters } from 'vuex';
    import DivContainer from "../../components/shared/div-container";
    import TagTitle from "../../components/shared/tag-title";
    import FormDefault from "../../components/shared/form-default";

    export default {
        name: "About",
        components: {FormDefault, TagTitle, DivContainer},

        computed: {
            ...mapGetters({currentUser: 'loggedUser'}),
        }
    }
</script>
