import { mapActions } from 'vuex'

export const logout = {
    methods: {
        ...mapActions({ logout: 'logout'})
    },
}

export const countDown = {

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

