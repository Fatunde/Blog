<template>
<div>

    <div class="" style="color: #00008B; font-weight: 700" v-if="loaded">

        <DashboardNavbar />
        <div class="m-4">
            <h3 class="text-center" style="font-weight: 700">Welcome {{User.name}}</h3>
        </div>
        <div class="text-center" style="font-weight: 700" v-if="User.disable == 1">
            <p class="checks">Your account has been disabled by the Management, contact the Administrator to Re-enable your account</p>
        </div>
        <div class="text-center" style="font-weight: 700" v-else-if=" User.paid == 1 && User.activated == null">
            <p class="checks">You have no post and you can't create any for now until your account has been approved, check your account status</p>
        </div>
        <div class="text-center" style="font-weight: 700" v-else-if="posts.length <=0 && User.paid == null">
            <p class="checks">You have no post and you can't create any post until you pay 1000Naira
                Click this button below to make payment</p> <br />
            <router-link class="button btn " to="/payment">
                <h4 class="mt-2">Pay</h4>
            </router-link>
        </div>
        <div class="text-center" style="font-weight: 700" v-else-if="posts.length <=0 && User.paid == 1 && User.activated == 1">
            <p class="checks">You have no post click the button below to create your first post</p><br />
            <router-link class="button btn " to="/create">
                <h4 class="mt-2">Create Post</h4>
            </router-link>
        </div>
        <div v-else>
            <h4 class="mt-5" style="font-weight: 700">Here are your post</h4>

            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">

                    </div>

                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="row  ml-lg-5">

                <div class="card" v-bind:key="post.id" v-for="post in posts">
                    <router-link :to="{name:'Show', params:{id: post.id}}" style="color: black; text-decoration: none;">

                        <img class="card-img-top" :src='`images/${post.image}`' alt="Card image cap" style="height: 300px">

                        <div class="card-body text-center">
                            <h5 class="card-title">{{post.title}}</h5>
                            <p class="card-text">{{post.body}}</p>

                            <small class="text-muted">On {{post.created_at}}</small>
                        </div>
                    </router-link>
                    <div class="mt-5 text-center row m-auto">
                        <router-link :to="{name: 'edit', params: {id: post.id}}" class="btn button ">
                            <p class="mt-3">Edit</p>
                        </router-link>
                        <button class="btn btn-danger" @click="deletePost(post)">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-else>
        <div class="text-center text-white justify-content-center">
            <div class="container">
                <div class="box">
                    <h2 class="">Please wait</h2>
                </div>
            </div>
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

Vue.use(Loading);

export default {
    components: {
        DashboardNavbar
    },

    data() {
        return {
            User: {
                name: "",
                email: "",

            },

            posts: [],
            post: {
                id: "",
                title: "",
                body: ""
            },

            post_id: "",
            pagination: {},
            edit: false,
            loaded: false
        }

    },

    created() {

        let loader = this.$loading.show({
            container: this.fullPage ? null : this.$refs.formContainer,
            canCancel: true,
            onCancel: this.onCancel,

        });

        axios.get('/auth/me', {
            headers: {
                Authorization: 'Bearer' + localStorage.getItem('token')
            }
        }).then(response => {
            if (response.status == 401) {
                this.$router.push('/login')
            } else {
                this.loaded = true
                localStorage.setItem('User', JSON.stringify(response.data[0].original))
                localStorage.setItem('posts', this.posts = JSON.stringify(response.data[0].original.posts))
                this.User = JSON.parse(localStorage.getItem('User'))
                this.posts = JSON.parse(localStorage.getItem('posts'))
                if (JSON.parse(localStorage.getItem('posts'))) {
                    loader.hide()
                } else {
                    this.$loading.show
                };
            }

        }).catch(error => {
            this.loginError = true
        });

    },

    methods: {

        deletePost(post) {
            this.posts.splice(this.posts.indexOf(post), 1)
            axios.delete('/auth/posts/' + post.id).then((response) => {
                    console.log(response)
                }

            ).catch(error => {
                console.log(error)
            })
        }
    },

    /*  this.$swal({
          title: 'Are you sure?',
          text: 'You can\'t revert your action',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes Delete it!',
          cancelButtonText: 'No, Keep it!',
          showCloseButton: true,
          showLoaderOnConfirm: true
      }).then( */
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

.Username {
    margin: auto;
}

.checks {
    font-size: 20px;
}

.card {
    margin: 10px;
    height: 100%;
    width: 500px;
    margin-top: 5px;
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

button {
    text-decoration: none;
    background-color: red;
    height: 60px;
    width: 220px;
    opacity: 80%;
    border-radius: 50px !important;
    color: white;
    text-align: center;
    font-weight: 700;
}

.button {
    text-decoration: none;
    background-color: #00008B;
    height: 60px;
    width: 220px;
    opacity: 80%;
    border-radius: 50px !important;
    color: white;
    text-align: center;
    font-weight: 700;
}
</style>
