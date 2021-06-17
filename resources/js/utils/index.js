
export const logout = {
    methods: {
        logout() {
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

