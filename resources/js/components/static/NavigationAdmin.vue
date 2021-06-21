<template>

    <div class="buttons-circle flex justify-between items-center my-6">

        <div class="rounded-full bg-white text-black text-2xl
                        h-12 w-12 p-2 px-1 text-gray-800 border-2 hover:border-black
                        text-center">
            <font-awesome-icon icon="cog"/>
        </div>

        <div class="rounded-full text-green-500 w-23 h-23 p-4 bg-white
                    border-2 hover:border-black">
            <font-awesome-icon icon="check"/>
        </div>


        <router-link :to="{ name: 'register' }">
            <div class="rounded-full bg-white text-black text-2xl h-12 w-12 px-3 py-2
                        border-2 hover:border-black">
                <font-awesome-icon icon="user"/>
            </div>
        </router-link>

    </div>

</template>

<script>
    export default {
        name: "NavigationAdmin"
    }
</script>
