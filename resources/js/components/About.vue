<template>
<div>
    <Navbar />
    <div class="container bg-transparent">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card w-lg-25%">
                    <div class="card-body w-lg-25%">
                        <div class="text-center about">About Us</div>
                        <div>
                            <p class="text-ceter">We love peolple to show love between each other which is the primary goal of this platform and also posting an sharing ideas
                                helps our community grow and makes us understand each other more.<br />
                                We also made it easy for our customers to pour out there mind to the world because everyone matters with each and every of their respective
                                opinion. We also help in content management and make sure our clients don't violate any of our guide lines, we teach, educate, and
                                entertain. We are MANAGEMENT.</p>
                        </div>
                        <div class="text-center" style="font-size: 25px; color: #00008B; font-weight: 700">Contact Us</div>
                        <p class="text-center"><i class="fas fa-envelope mr-2" style="font-size: 25px"></i> Blog@blog.com</p>
                        <p class="text-center"><i class="fab fa-facebook mr-2" style="font-size: 25px"></i> @Blog.facebook.com </p>
                        <p class="text-center"><i class="fas fa-phone-square-alt mr-2" style="font-size: 25px"></i> 08011122233</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from "axios";
import Navbar from './Navbar.vue';
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
            error: "",
            email: "",
            password: "",
            loginError: false,
            formError: false,
            emailError: false
        }
    },

}
</script>

<style scoped>
.about {
    color: #00008B;
    font-weight: 700;
    font-size: 30px;
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

p {
    color: #00008B;
    font-size: 18px;
    margin-top: 5px;
    text-align: center;
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
    width: 400px;
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
