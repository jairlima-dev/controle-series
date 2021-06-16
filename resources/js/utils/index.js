
export const logOut = {
    methods: {
        handleLogout() {
            this.$store.dispatch('logout')
                .then(() => this.$router.push({ name: 'login'}))

        }
    },
}

export const countDown = {

    created() {
        this.countDownTimer()
    },

    methods: {
        countDownTimer() {
            if(this.countDown > 0) {
                setTimeout(() => {
                    this.countDown -= 1
                    this.countDownTimer()
                }, 1000)
            }
        }
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

export const checkToken = {
    // created() {
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

