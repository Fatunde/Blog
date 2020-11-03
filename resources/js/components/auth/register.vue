<template>
<div>

    <div class="container">

        <div class="row justify-content-center ">
            <div class="col-md-8">
                <div class="card ">
                    <div class="alert alert-danger text-center" role="alert" v-if="error">
                        Email already exist
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-danger text-center" role="alert" v-if="passwordError">
                        Password does not match
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
                    <div class="alert alert-danger text-center" role="alert" v-if="passwordError1">
                        Password must be at least 8 characters
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-danger text-center" role="alert" v-if="emailError">
                        Email not valid
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div>
                            <h3 class="text-center">Sign Up</h3>

                        </div>
                        <form method="POST" action="/register" class="mt-5">

                            <div class="form-group ">
                                <label for="name" class="">First Name</label>

                                <div class="">
                                    <input id="name" type="text" class=" input form-control border text-muted" style=" font-weight:100" name="name" value="" placeholder="Enter your name" required autocomplete="name" autofocus v-model="name">
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="name" class="">Last Name</label>

                                <div class="">
                                    <input id="name" type="text" class=" input form-control border text-muted" style=" font-weight:100" name="name" value="" placeholder="Enter your name" required autocomplete="name" autofocus v-model="lastName">
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="">Email</label>

                                <div class="">
                                    <input id="email" type="email" class=" input form-control border text-muted" style=" font-weight:100" placeholder="Enter your email" name="email" value="" required autocomplete="email" autofocus v-model="email">
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="">Password</label>

                                <div class="">
                                    <input id="password" type="password" class=" input form-control border text-muted" style=" font-weight: 100" name="password" required autocomplete="new-password" placeholder="Enter a password" v-model="password">

                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="">Confirm Password</label>

                                <div class="">
                                    <input id="password-confirm" type="password" class=" input form-control border text-muted" style=" font-weight:100" name="password_confirmation" required autocomplete="new-password" placeholder="Re-enter the password" v-model="password_confirmation">
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="">
                                    <input type="file" v-on:change="onImageChange" id="upload" hidden />
                                    <label class="file text-center" for="upload"><i class="fas fa-camera"></i></label>
                                    <div class="col-md-3" v-if="image" style="margin: auto;">
                                        <img :src="image" class="img-responsive" height="90" width="90" style="margin-left: 30px;">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="button  text-white" @click="handleSubmit">
                                <p> Sign Up </p>
                            </button>
                            <div class="form-group row mb-0">
                                <div class="col">
                                    <div class="mt-5">
                                        <router-link to="/" class="mt-5" style="text-decoration: none; color: #00008B">Home Page</router-link>
                                    </div>
                                </div>
                                <div class="col-auto mt-5">
                                    <router-link to="/login" class=" my-2 my-sm-0 " style="text-decoration:none; margin-right-auto; color: #00008B">
                                        <p>Log In</p>
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
import Navbar from "../Navbar"
export default {

    components: {
        Navbar
    },
    data() {
        return {
            passwordError: false,
            formError: false,
            passwordError1: false,
            emailError: false,
            error: "",
            name: "",
            lastName: "",
            email: "",
            password: "",
            password_confirmation: "",
            image: ""
        }
    },

    methods: {

        onImageChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]);
        },
        createImage(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        validEmail: function (email) {
            var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        },
        handleSubmit(e) {

            e.preventDefault()

            if (this.password !== this.password_confirmation) {
                this.passwordError = true
            } else if (!this.name || !this.email || !this.password || !this.password_confirmation) {
                this.formError = true
            } else if (this.password.length < 8 || this.password_confirmation.length < 8) {
                this.passwordError1 = true
            } else if (!this.validEmail(this.email)) {
                this.emailError = true
            } else {

                axios.post('http://127.0.0.1:8000/api/auth/register', {
                        name: this.name,
                        lastName: this.lastName,
                        email: this.email,
                        password: this.password,
                        c_password: this.password_confirmation,
                        image: this.image
                    })
                    .then(response => {
                        if (response.status == 200) {
                            this.$router.push('/success')
                            console.log(response.status)
                        }
                    })
                    .catch(error => {
                        this.error = error
                    });

            }
        }
    },

}
/*
.then(response => {
                    localStorage.setItem('user',response.data.success.name)
                    localStorage.setItem('jwt',response.data.success.token)

                    if (localStorage.getItem('jwt') != null){
                        this.$router.go('/board')
                    }
                  })*/
</script>

<style scoped>
.file {
    background-color: #00008B;
    color: white;
    padding: 0.5rem;
    border-radius: 0.3rem;
    cursor: pointer;
    margin-top: 10px;
    width: 50px;
    font-size: 20px;

}

form {
    font-size: 18px;
    font-weight: bold;
    color: #00008B;
}

.button {
    margin: auto;
    text-align: center;
    width: 318px;
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
    font-weight: 20px;
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

.input {
    height: 50px;
    font-weight: 5px;
}

.input [type="text"]:focus {
    outline: none;
    box-shadow: none !important;
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
