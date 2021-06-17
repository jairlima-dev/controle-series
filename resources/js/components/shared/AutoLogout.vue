<template>
    <div v-if="warningZone">Olá! Você será desconectado em {{ countDown }} segundos!</div>
</template>

<script>

    import { logout } from "../../utils";

    export default {
        name: "AutoLogout",
        props: {
            timeout: {
                type: Number,
                default: 30
            }
        },

        mixins: [logout],

        data() {
            return {
                events: ['click', 'mousemove', 'mousedown', 'scroll', 'keypress', 'load'],
                warningTimer: null,
                logoutTimer: null,
                warningZone: false,
                countDown: null,
            }
        },

        mounted() {
            this.events.forEach((event) => {
                window.addEventListener(event, this.resetTimers);
            });

            this.setTimers();
        },

        destroyed() {
            this.events.forEach(function (event) {
                window.removeEventListener(event, this.resetTimers);
            }, this);

            this.resetTimers();
        },

        methods: {
            setTimers() {
                this.warningTimer = setTimeout(this.warningMessage, (this.timeout - 1) * 60 * 1000);
                this.logoutTimer = setTimeout(this.logoutUser, (this.timeout) * 60 * 1000);

                this.warningZone = false

            },

            resetTimers() {
                clearTimeout(this.warningTimer);
                clearTimeout(this.logoutTimer);

                this.setTimers();

            },

            logoutUser() {
                if (this.$store.state.token !== '') {
                   this.logout()
                }
            },

            warningMessage() {
                this.countDown = 60;
                this.countDownTimer();
                this.warningZone = true;
            },

            countDownTimer() {
                if(this.countDown > 0) {
                    setTimeout(() => {
                        this.countDown -= 1
                        this.countDownTimer()
                    }, 1000)
                }
            }

        }

    }
</script>
