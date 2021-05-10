<template>

<div>

    <router-link :to="{ name: to, params:  { id  } }">

        <div v-if="add" class="border-4 border-blue-300 hover:border-blue-600
            text-blue-400 font-bold text-xl h-12 pt-2 px-3 mr-2 rounded-md">
            <i v-if="add" class="fas fa-plus-circle"/>
            {{ tag }}
        </div>

        <div v-if="link" class="border-4 border-blue-300 hover:border-blue-600
            text-blue-400 font-bold text-xl h-12 pt-2 px-3 mr-2 rounded-md">
            <i v-if="link" class="fas fa-external-link-alt"/>
            {{ tag }}
        </div>

        <div v-if="edit" class="border-4 border-yellow-300 hover:border-yellow-600
            text-yellow-400 font-bold text-xl h-12 pt-2 px-3 mr-2 rounded-md">
            <i v-if="edit" class="fas fa-pen"/>
            {{ tag }}
        </div>

        <div v-if="del" class="border-4 border-red-300 hover:border-red-600
            text-red-400 font-bold text-xl h-12 pt-2 px-3 mr-2 rounded-md">
            <i v-if="del" class="fas fa-trash-alt"/>
            {{ tag }}
        </div>

        <div v-if="save" class="border-4 border-blue-300 hover:border-blue-600
            text-blue-400 font-bold text-xl h-12 pt-2 px-3 mr-2 rounded-md">
            <i v-if="save" class="fas fa-check"/>
            {{ tag }}
        </div>

    </router-link>

</div>

</template>

<script>
    export default {

        props: [
            'to',
            'id',
            'tag',
            'add',
            'link',
            'del',
            'edit',
            'save'
        ]
    }
</script>

