<template>
<div>
    <DashboardNavbar />
    <div class="container bg-transparent">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card text-center ">
                    <div class="card-body">
                        <h4 class="display-4 " style="color: #00008B; font-weight: 700;">Your Payment has been made successfully </h4>
                        <div class="success"></div>
                        <p class="lead mt-4" style="color: #00008B; font-weight: 700;">Click on the button below to go to dashboard</p>

                        <router-link class="button btn" to="/dashboard">
                            <p class="mt-3" style=" font-weight: 700;">Dashboard</p>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from "axios";
import DashboardNavbar from './DashboardNavbar.vue';
import Loading from 'vue-loading-overlay';
import Vue from 'vue';
import 'vue-loading-overlay/dist/vue-loading.css';

Vue.use(Loading);

export default {
    components: {
        DashboardNavbar
    },

    data() {
        return {

        }
    },

}
</script>

<style scoped>
.success {
    background-image: url("./check.svg") !important;
    height: 100px;
    width: 100px;
    margin: auto;
}

.card {
    margin-top: 50px;
    height: 100%;
    background-color: transparent;
    opacity: 80%;
    border-radius: 10px !important;
}

@media screen and (max-width: 600px) {

    h4 {
        font-size: 25px !important;
    }
}

.card:hover {
    background-color: white;
    opacity: 200%;
    background-color: rgba(245, 245, 245, 0.4);
    transform: scale(1.10) translateZ(0);
    transition-duration: 0.5s;
    transition-timing-function: linear;
}

.button {
    text-decoration: none;
    background-color: #00008B;
    height: 70px;
    width: 250px;
    opacity: 80%;
    border-radius: 50px !important;
    color: white;
    text-align: center;

}

.button:hover {

    background-color: white;
    opacity: 200%;
    transform: scale(1.10) translateZ(0);
    transition-duration: 0.5s;
    transition-timing-function: linear;
    color: #00008B;

}
</style>
