<template>

    <div class="container mx-auto">
        <top-bar/>
        <navigation-panel/>
    </div>

</template>

<script>

    import { logout} from "../utils";
    import NavigationPanel from "../components/static/NavigationPanel";
    import TopBar from "../components/static/TopBar";

    import ErrorsDefault from "../components/shared/errors-default";

    export default {
        name: "App",
        components: {ErrorsDefault, TopBar, NavigationPanel },
        mixins: [logout],

    }

</script>
