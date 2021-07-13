<template>

    <div :class="styleMessage">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        name: "Message",
        
        props: ['type'],

        computed: {
            styleMessage() {
                if (!this.type) { return "text-2xl px-4 py-2 mx-2 my-4 w-50 " +
                 "ring ring-offset-2 ring-blue-300 rounded-md bg-blue-100 block"
                }
                if (this.type === 'danger') { return "text-2xl px-4 py-2 mx-2 my-4 w-50 " +
                     "ring ring-offset-2 ring-red-300 rounded-md bg-red-100 block"
                }
            }
        }

    }
</script>


