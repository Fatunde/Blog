<template>
<div>

    <div class="container bg-transparent">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card w-lg-25%">
                    <div class="alert alert-danger text-center" role="alert" v-if="error">
                        Email and password not match
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-danger text-center" role="alert" v-if="formError">
                        All fields are required
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-danger text-center" role="alert" v-if="emailError">
                        You have entered an invalid email
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="card-body w-lg-25%">
                        <div class="text-center">
                            <h3>Login</h3>
                        </div>

                        <form class="form-signin vld-parent mt-5" v-on:submit.prevent="submitLogin">

                            <div class="form-group">
                                <label for="email" class="">Email</label>

                                <div class="">
                                    <input id="email" type="email" class=" input form-control border text-muted" style=" font-weight" placeholder="Enter your email" name="email" value="" required autocomplete="email" autofocus v-model="email">
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="password" class="">Password</label>

                                <div class="input group ">
                                    <input :type="type" class="input form-control border text-muted" name="password" id="password" placeholder="Enter the password" v-model="password">
                                    <a class="btn" @click="showPassword" style="color:  #00008B; font-weight: bold; font-size: 13px; margin-left: -12px;">{{btnText}}</a>
                                </div>
                            </div>
                            <button type="submit" class="button text-white" @click="submitLogin">
                                <p> Login </p>
                            </button>
                            <div class="form-group row mb-0">
                                <div class="col">
                                    <div class="mt-5">
                                        <router-link to="/" class="mt-5" style="text-decoration: none; color: #00008B">Home Page</router-link>
                                    </div>
                                </div>
                                <div class="col-auto mt-5">
                                    <router-link to="/register" class=" my-2 my-sm-0 " style="text-decoration:none; margin-right-auto; color: #00008B">
                                        <p>Sign Up</p>
                                    </router-link>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from "axios";
import Navbar from '../Navbar.vue';
import store from '../store';
import Loading from 'vue-loading-overlay';
import Vue from 'vue';
import 'vue-loading-overlay/dist/vue-loading.css';

Vue.use(Loading);

export default {
    components: {
        Navbar
    },

    data() {
        return {
            btnText: "",
            error: "",
            email: "",
            password: "",
            loginError: false,
            formError: false,
            emailError: false,
            type: 'password',
            btnText: 'Show Password',

        }

    },
    methods: {

        validEmail: function (email) {
            var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        },
        submitLogin(e) {

            if (!this.email || !this.password) {
                this.formError = true
            } else if (!this.validEmail(this.email)) {
                this.emailError = true
            } else {
                this.loginError = false;
                axios.post('/auth/login', {
                    email: this.email,
                    password: this.password
                }).then(response => {
                    store.commit('loginUser')
                    localStorage.setItem('token', response.data.access_token)
                    this.$router.push('/loading')
                }).catch(error => {
                    this.error = error
                });

            }
        },

        showPassword() {
            if (this.type === 'password') {
                this.type = 'text'
                this.btnText = 'Hide Password'
            } else {
                this.type = 'password'
                this.btnText = 'Show Password'
            }
        }

    }

}
</script>

<style scoped>
.input-group i {
    cursor: pointer;
}

form {
    font-size: 18px;
    font-weight: bold;
    color: #00008B;
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
}

.button:hover {
    background-color: white;
    border: white
}

.button p {
    font-size: 23px;
    font-weight: 700;
    margin-top: 5px;
}

.button p:hover {
    color: #00008B
}

h3 {
    margin: auto;
    color: #00008B;
    font-weight: 700;
}

input {
    height: 50px;
    font-weight: 5px;
}

input [type="text"]:focus {
    outline: none;
    box-shadow: none !important;
    border: 10px
}

.card {
    width: 360px;
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

input::placeholder {
    font-weight: 100;
    font-size: 12px;
}
</style>
