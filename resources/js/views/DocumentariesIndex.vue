<template>
    <p>Documentários</p>
</template>

<script>
    import {verifyToken} from "../utils";

    export default {
        name: "DocumentariesIndex",
        mixins: [verifyToken]
    }
</script>
