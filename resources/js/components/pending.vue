<template>
<div v-if="loaded">
    <DashboardNavbar />

    <div class="container bg-transparent" v-if="User.disable == 1">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card text-center ">
                    <div class="card-body">
                        <h1 class="mb-5">
                            <h style="color: #00008B">Account Status</h>
                            <h1 class="text-warning">Disabled</h1>
                        </h1>
                        <h4 class="display-4">Your account has been disabled by the Management, contact the Administrator to Re-enable your account</h4>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container bg-transparent" v-else-if="User.activated == 1">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card text-center ">
                    <div class="card-body">
                        <h1 class="mb-5">
                            <h style="color: #00008B">Account Status</h>
                            <h1 class="text-success">Activated</h1>
                        </h1>
                        <h4 class="display-4">Your account has been activated, You can now ceate posts. Enjoy!</h4>

                        <router-link class="button btn" to="/create">
                            <p class="mt-2">Click here to create your post</p>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container bg-transparent" v-else-if="User.paid == 1 && User.activated == null">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card text-center ">
                    <div class="card-body">
                        <h1 class="mb-5">
                            <h style="color: #00008B">Account Status</h>
                            <h1 class="text-warning">Pending</h1>
                        </h1>
                        <h4 class="display-4">Your account will be activated by the administrator before you can start creating post</h4>

                        <router-link class="button btn" to="/userblog">
                            <p class="mt-2">Click here to View Blogs</p>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container bg-transparent" v-else-if="User.paid == null">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card text-center ">
                    <div class="card-body">
                        <h1 class="mb-5">
                            <h style="color: #00008B">Account Status</h>
                            <h1 class="text-danger">Yet to Pay</h1>
                        </h1>
                        <h4 class="display-4">Your account will not be activated by the administrator until you pay 1000Naira</h4>

                        <router-link class="button btn" to="/payment">
                            <p class="mt-2">Click here to Pay</p>
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
import DashboardNavbar from './DashboardNavbar';
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
            User: {
                email: "",
                paid: "",
                activated: "",
            },
            loaded: false
        }
    },
    mounted() {
        axios.get('/api/auth/me', {
                headers: {
                    Authorization: 'Bearer' + localStorage.getItem('token')
                }
            })
            .then(response => {
                this.User = response.data[0]
                this.posts = response.data[0].posts
                this.paid = response.data[0].paid
                this.activated = response.data[0].activated
                this.id = this.User.id

                this.loaded = true

            })

    },

}
</script>

<style scoped>
.card {
    margin-top: 50px;
    height: 400px;
    background-color: transparent;
    opacity: 80%;
    border-radius: 10px !important;
}

h4 {
    color: #00008B;
    font-size: 35px;
    font-weight: 700;
}

.button {
    margin: auto;
    text-align: center;
    width: 315px;
    height: 60px;
    margin-top: 20px;
    background-color: #00008B;
    border: none !important;
    outline: none !important;
    border-radius: 5px;
    color: white;
}

.button:hover {
    background-color: white;
    border: white
}

.button p {
    font-size: 19px;
    font-weight: 700;
    margin-top: 3px;
}

.button p:hover {
    color: #00008B
}

h3 {
    margin: auto;
    color: #00008B;
    font-weight: 700;
}

.input {
    height: 50px;
    font-weight: 5px;
}

input :placeholder-shown {
    font-size: 12px;
}

.input [type="text"]:focus {
    outline: none;
    box-shadow: none !important;
}

.card {
    height: 100%;
    width: 500px;
    margin: auto;
    margin-top: 50px;
    background-color: white;
    opacity: 80%;
    border-radius: 10px !important;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    transition: 0.3s;
}

.card:hover {

    opacity: 200%;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    transform: scale(1.05) translateZ(0);
    transition-duration: 0.5s;
    transition-timing-function: linear;
}

@media screen and (max-width: 600px) {

    h4 {
        font-size: 25px !important;

    }

    .card {
        width: 400px;
    }
}
</style>
