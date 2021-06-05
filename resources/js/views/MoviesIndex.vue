<template>
    <p>Filmes</p>
</template>

<script>
    import {verifyToken} from "../utils";

    export default {
        name: "FilmesIndex",
        mixins: [verifyToken]
    }
</script>
