<template>
<div class="all">

    <div class="">
        <div>
            <DashboardNavbar />
        </div>
        <div class="row justify-content-center ">
            <div class="col-md-8">
                <div class="card ">

                    <div class="card-body">
                        <div>
                            <h3 class="text-center">Edit Your Profile</h3>
                        </div>
                        <form method="POST" action="/register" class="mt-5">

                            <div class="form-group ">
                                <label for="name" class="">First Name</label>

                                <div class="">
                                    <input id="name" type="text" class=" input form-control border text-muted" style="font-size: 12px; font-weight" value="" required autocomplete="name" autofocus v-model="User.name">
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="name" class="">Last Name</label>

                                <div class="">
                                    <input id="name" type="text" class=" input form-control border text-muted" style="font-size: 12px; font-weight" value="" required autocomplete="name" autofocus v-model="User.lastName">
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <button type="submit" class="button  text-white" @click="handleSubmit">
                                <p> Upload</p>
                            </button>

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
import DashboardNavbar from "./DashboardNavbar"
export default {

    components: {
        DashboardNavbar
    },
    data() {
        return {
            User: {},

            emailError: false,
            error: false,
            id: ""

        }

    },

    created() {

        this.User = JSON.parse(localStorage.getItem('User'))
        this.id = this.User.id

    },

    methods: {

        handleSubmit(e) {

            e.preventDefault()

            axios.put('/api/auth/userUpdate' + this.id,
                    this.User)
                .then(response => {
                    this.$router.push('/profileupdatesuccess')
                })
                .catch(error => {
                    this.error = error
                });

        }
    }

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
.all {
    background: url('./images/contact-background.jpg');
    height: 100%;
}

form {
    font-size: 15px;
    font-weight: bold;
    color: #00bfd8;
}

.button {
    margin: auto;
    text-align: center;
    width: 305px;
    height: 60px;
    margin-top: 20px;
    background-color: #00bfd8;
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
    color: #00bfd8
}

h3 {
    margin: auto;
    color: #00bfd8
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
    width: 350px;
    margin: auto;
    margin-top: 50px;
    background-color: #e8f7f8;
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
</style>
