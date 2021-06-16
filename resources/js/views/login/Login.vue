<template>
    <div class="min-h-screen">

        <div class="flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">

            <div class="max-w-md w-full space-y-8">
                <div>
                    <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
                         alt="Workflow" />

                    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                        Entre com os dados de acesso
                    </h2>

                </div>
                <form class="mt-8 space-y-6">
                    <div class="rounded-md shadow-sm block justify-center">
                        <div>
                            <input-form rules="required|email"
                                        label-text="Endereço de Email"
                                        size="lg"
                                        v-model="credentials.email"/>
                        </div>
                        <div>
                            <input-form rules="required|min:6"
                                        type="password"
                                        label-text="Senha"
                                        size="lg"
                                        v-model="credentials.password"/>
                        </div>
                    </div>

                    <div class="flex justify-center">

                        <button-action v-if="credentials.email && credentials.password"
                                       type="unlock" tag="Acessar" @execute="handleLogin"/>
                        <button-action v-else type="lock" tag="Acessar"/>

                    </div>
                </form>
            </div>
        </div>

    </div>

</template>

<script>

    import ButtonAction from "../../components/shared/button-action";
    import InputForm from "../../components/shared/input-form";
    import Message from "../../components/shared/message";
    import ErrorsDefault from "../../components/shared/errors-default";

    export default {
        components: {
            ErrorsDefault, InputForm, Message, ButtonAction,
        },

        data() {
          return {
              credentials: {
                  email: '',
                  password: '',
              }
          }
        },

        methods: {
            handleLogin() {
                this.$store.dispatch('login', this.credentials)
                    .then( () => this.$router.push({ name: 'series.index' }))
            },
        }
    }
</script>
