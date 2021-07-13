<template>

    <router-link :to="{ name: to, params:  { id, numero, nome } }">

        <div :class="styleButton">
            <font-awesome-icon :icon="iClass"/>
            {{ tag }}
        </div>

    </router-link>

</template>

<script>
    export default {
        name: "ButtonLink",
        props: [
            'type', 'tag','to', 'id', 'numero', 'nome',
        ],

        computed: {
            iClass() {
                if (this.type === 'add') return "plus-circle";
                if (this.type === 'link') return "external-link-alt";
                if (this.type === 'edit') return "pen";
                if (this.type === 'delete') return "trash-alt";
                if (this.type === 'save') return "check";
            },

            styleButton() {
                if (this.type === 'add' ||
                    this.type === 'link' ||
                    this.type === 'save') {
                    return "border-4 border-blue-400 hover:border-blue-700 " +
                        "text-blue-500 font-bold text-xl h-12 pt-2 px-3 mr-2 rounded-md"
                }
                if (this.type === 'edit') {
                    return "border-4 border-yellow-400 hover:border-yellow-700 " +
                        "text-yellow-500 font-bold text-xl h-12 pt-2 px-3 mr-2 rounded-md"
                }
                if (this.type === 'delete') {
                    return "border-4 border-red-400 hover:border-red-700 " +
                        "text-red-500 font-bold text-xl h-12 pt-2 px-3 mr-2 rounded-md"
                }
            },

        },
    }
</script>

