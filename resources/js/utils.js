import axios from "axios";

export const checkToken = {
    mounted() {
        if (this.$store.state.token !== '') {
            axios.post('/api/checkToken', { token: this.$store.state.token })
                .then(response => {
                    if (!response.data.success) {
                        this.$store.commit('setToken', response.data.token);
                    }
                    this.message = null;
                })
                .catch(error => {
                    this.message = null;
                    this.$router.push({ name: 'login'});
                })
        } else {
            this.$router.push({ name: 'login'});
        }
    },

}

export const getUser = {
    methods: {
        getUser() {
            if (this.$store.state.token) {
                axios.post(`/api/getUser`,{ 'token': this.$store.state.token })
                    .then(response => {
                        this.$store.commit('setUser', response.data.user)
                    }).catch(error => {
                    console.log('Não peguei o usuário')
                })
            }
        },
    },
}

export const refresh = {
    methods: {
        refresh() {
            this.message = this.error = null;
            this.fetchData();
            setTimeout(() => this.message = null, 3000);
        },
    },
}




