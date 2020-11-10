<template>
<div class="all">
    <DashboardNavbar />
    <div class="text-center mt-5" style="font-weight: 700; font-size: 30px; color: #00bfd8" v-if="User.disable == 1">
        <p class="checks">Your account has been disabled by the Management, contact the Administrator to Re-enable your account</p>
    </div>
    <div class="container" v-else-if="User.paid == 1 && User.activated == 1">

        <div class="card p-lg-5">
            <div class="card-body m-auto">
                <h2 class="text-center">Create New Post</h2>
                <form @submit.prevent="updatePost">
                    <div class="form-group">
                        <label for="email" class="">Post Title</label>

                        <div class="">
                            <input id="email" class="form-control" name="post" value="" autofocus v-model="title">
                            <span class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="text-field">Post body</label>

                        <div class="">
                            <textarea class="form-control " id="exampleFormControlTextarea1" rows="7" v-model="body"></textarea>

                            <span class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3" v-if="image">
                            <img :src="image" class="img-responsive" height="70" width="90">
                        </div>
                        <div class="col-md-6">
                            <input type="file" v-on:change="onImageChange" class="form-control" hidden id="upload">
                            <label class="file text-center" for="upload">Add Picture</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn  text-white" @click="handleSubmit">
                            <p> Post </p>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from "axios";
import DashboardNavbar from '../DashboardNavbar'

export default {
    components: {
        DashboardNavbar
    },
    data() {
        return {
            User: {
                paid: "",
                activated: ""
            },
            title: "",
            body: "",
            user_id: "",
            user_name: "",
            image: ""
        }

    },

    mounted() {
        axios.get('/api/auth/me', {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token')
                }
            })
            .then(response => {
                this.User = response.data[0]

                console.log(this.User)
                if (this.User.paid == null) {
                    this.$router.push("/payment")
                } else if (this.User.paid == 1 && this.User.activated == null) {
                    this.$router.push("/pending")
                } else {

                    this.id = this.User.id
                    this.name = this.User.name

                }
            }).catch(error => {
                console.log(error)
            })

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
        handleSubmit(e) {
            e.preventDefault()

            axios.post('/api/auth/posts', {
                    title: this.title,
                    body: this.body,
                    id: this.id,
                    name: this.name,
                    image: this.image
                })
                .then(
                    this.$router.push({
                        name: 'Dashboard'
                    }),

                )

                .catch(error => {
                    console.error(error);
                });

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
.all {
    background: url('../images/contact-background.jpg');
}

.file {
    background-color: #00bfd8;
    color: white;
    padding: 0.5rem;
    border-radius: 0.3rem;
    cursor: pointer;
    margin-top: 1rem;
    width: 250px;
    margin-left: 1rem;

}

form {
    font-size: 15px;
    font-weight: bold;
    color: #00bfd8;
}

button {
    margin: auto;
    text-align: center;
    width: 305px;
    height: 60px;
    margin-top: 20px;
    background-color: #00bfd8;
}

button:hover {
    background-color: white;
}

h2 {
    font-weight: 700;
    color: #00bfd8;
}

button p {
    font-size: 23px;
    font-weight: 20px;
    margin-top: 5px;
}

button p:hover {
    color: #00bfd8
}

h3 {
    margin: auto;
    color: #00bfd8
}

.input {
    height: 50px;
    font-weight: 5px;
    width: 700px;
}

.input [type="text"]:focus {
    outline: none;
    box-shadow: none !important;
}

.card {
    width: 100%;
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

@media screen and (max-width: 600px) {

    .input {
        height: 50px;
        font-weight: 5px;
        width: 250px;
    }

}
</style>
