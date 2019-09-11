<template>
    <div class="alert  alert-flash" :class="'alert-'+level" role="alert" v-show="show" v-text="body">

    </div>
</template>

<script>
    export default {
        props: ["message"],
        data() {
            return {
                body: this.message,
                level: 'success',
                show: false
            };
        },
        created() {
            if (this.message) {
                this.flash();
            }
            window.events.$on("flash", message => {
                this.flash(message);
            });
        },
        methods: {
            flash(message) {
                this.body = message;
                this.show = true;
                this.hide();
            },
            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 3000);
            }
        },
        mounted() {
            console.log("Component mounted.");
        }
    };
</script>
<style>
    .alert-flash {
        position: fixed;
        right: 25px;
        bottom: 20px;
    }
</style>
