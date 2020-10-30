<template>
<div class="app">
    <div>
        <transition name="fade">
            <router-view></router-view>
        </transition>
    </div>
</div>
</template>

<style scoped>
template {
    height: 100% !important;
    background-size: 100%;
}

.app {
    background-color: white;

    font-family: 'Roboto', sans-serif !important;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    margin-top: 0px;
    height: 100% !important;

}

.container {
    background-color: transparent;
}

@import'~bootstrap/dist/css/bootstrap.css';

@import '~bootstrap-vue/dist/bootstrap-vue.css';

.fade-enter-active,
.fade-leave-active {
    transition: opacity .5s
}

.fade-enter,
.fade-leave-active {
    opacity: 0
}
</style>

<script>
import store from './components/store'
export default {

    created() {

        if (localStorage.token) {
            axios.get('/api/me', {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token')
                }
            }, ).then(response => {
                store.commit('loginUser')
            }).catch(error => {
                if (error.response.status === 401 || error.response.status === 403) {
                    store.commit('logoutUser')
                    localStorage.setItem('token', '')
                    this.$router.push({
                        name: 'login'
                    })
                }

            });
        }

    }
}
</script>
