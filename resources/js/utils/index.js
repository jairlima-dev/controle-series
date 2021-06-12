import api from '../api/auth'

export const checkToken = {
    // mounted() {
    //     if (this.$store.state.token !== '') {
    //         api.checkToken()
    //             .then(response => {
    //                 if (!response.data.success) {
    //                     localStorage.setItem('auth', response.data.token);
    //                     this.$store.commit('setToken', response.data.token);
    //                 }
    //                 this.message = null;
    //             })
    //             .catch(error => {
    //                 this.message = null;
    //                 this.$router.push({ name: 'login'});
    //             })
    //     } else {
    //         this.$router.push({ name: 'login'});
    //     }
    // },

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
