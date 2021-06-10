<template>
    <div-container>
        <tag-title>Documentários</tag-title>
        ... Em breve
    </div-container>
</template>

<script>
    import { checkToken } from "../../utils";
    import DivContainer from "../../components/shared/div-container";
    import TagTitle from "../../components/shared/tag-title";

    export default {
        name: "DocumentariesIndex",
        components: {TagTitle, DivContainer},
        mixins: [checkToken]
    }
</script>
