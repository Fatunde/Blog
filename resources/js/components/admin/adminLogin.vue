<template>
<div>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header  bg-primary text-white">Login</div>
                    <div class="card-body">
                        <form class="form-signin" v-on:submit.prevent="submitLogin">

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email Adress</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control " name="email" value="" required autocomplete="email" autofocus v-model="email">
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" v-model="password">

                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md md-4">
                                    <button type="submit" class="btn btn-primary" @click="submitLogin">
                                        Login
                                    </button>
                                    <router-link to="/register">
                                        <p>No Account?</p>
                                        <button type="submit" class="btn btn-primary">
                                            Register
                                        </button>
                                    </router-link>
                                    <a class="btn btn-link" href="#">
                                        Forgot your password
                                    </a>
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
//import store from '../store'

export default {

    data() {
        return {

            email: "",
            password: "",
            loginError: false,
        }
    },
    methods: {
        submitLogin(e) {
            this.loginError = false;
            axios.post('/auth/login', {
                email: this.email,
                password: this.password
            }).then(response => {
                // store.commit('loginUser')
                localStorage.setItem('token', response.data.access_token)
                this.$router.push('/admin/dashboard')
            }).catch(error => {
                this.loginError = true
            });
        }
    }
}
</script>
