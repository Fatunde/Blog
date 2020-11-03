<template>
<div class="text-center text-white justify-content-center">
    <div class="container">
        <div class="box">
            <h2 class="">Please wait</h2>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';
import DashboardNavbar from './DashboardNavbar';
import store from '../store';
import Loading from 'vue-loading-overlay';
import Vue from 'vue';
import 'vue-loading-overlay/dist/vue-loading.css';
export default {

    mounted() {

        let loader = this.$loading.show({
            container: this.fullPage ? null : this.$refs.formContainer,
            canCancel: true,
            onCancel: this.onCancel
        });

        axios.get('/api/auth/me', {
            headers: {
                Authorization: 'Bearer' + localStorage.getItem('token')
            }
        }).then(response => {

            // console.log(localStorage.getItem('token'))
            localStorage.setItem('User', JSON.stringify(response.data[0].original))
            localStorage.setItem('posts', this.posts = JSON.stringify(response.data[0].original.posts))
            this.User = JSON.parse(localStorage.getItem('User'))
            console.log(this.User.role)
            if (this.User.role == "admin") {
                this.$router.push('/admin/dashboard')
                loader.hide()
            } else if (this.User.role == "user") {
                this.$router.push('/dashboard')
                loader.hide()
            }

        }).catch(error => {
            this.loginError = true
        });

        /*

        })*/

    },
}
</script>

<style scoped>
.container {
    height: 10em;
    position: relative
}

.container h2 {
    margin: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%)
}
</style>
