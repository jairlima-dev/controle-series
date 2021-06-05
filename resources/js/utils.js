import axios from "axios";

export const verifyToken = {

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

export const navigate = {

    methods: {
        navigate(page) {
            axios.get(`${page}`)
                .then(response => {
                    this.series = response.data.data;
                    this.pagination = response.data;
                })
                .catch(error => {
                    this.error = error.response.data.errors
                })
        },
    }

}



