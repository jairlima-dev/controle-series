<template>

    <div class="text-2xl px-4 py-2 mx-2 my-4 w-50 ring ring-offset-2
                ring-red-300 rounded-md bg-red-100 block">
        <ul v-for="(err, idx) in error" :key='idx'>
            <li>{{ err[0] }}</li>
        </ul>
    </div>

</template>

<script>
    export default {
        name: "ErrorsDefault",
        props: ['error'],
    }
</script>
