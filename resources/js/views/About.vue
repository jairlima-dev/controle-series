<template>
    <p>About</p>
</template>

<script>
    import {verifyToken} from "../utils";

    export default {
        mixins: [verifyToken]
    }
</script>
