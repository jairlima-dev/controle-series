<template>
    <div>
        {{ countDown }}
    </div>
</template>

<script>

    export default {
        data() {
            return {
                countDown : 10
            }
        },

        created() {
            this.countDownTimer()
        },

        method: {
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
</script>
