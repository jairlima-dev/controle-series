<template>

</template>

<script>
    import api from '../api/auth';

    export default {
        name: "checkToken",

        created() {
            if (!this.$store.state.token) {
                this.$router.push({ name: 'login'});
            } else {
                api.checkToken()
                    .then(response => {
                        if (!response.data.success) {
                            localStorage.setItem('auth', response.data.token);
                            this.$store.commit('setToken', response.data.token);
                        }
                        this.message = null;
                    })
                    .catch(error => {
                        this.message = null;
                        this.$router.push({ name: 'login'});
                    })
            }
        },

    }
</script>
