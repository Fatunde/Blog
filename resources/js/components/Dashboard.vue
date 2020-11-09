<template>
<div class="all">

    <div class="" style="color: #00008B; font-weight: 700" v-if="loaded">

        <DashboardNavbar />

        <div class="m-4 mb-5">
            <h3 class="ml-3" style="font-weight: 700; color: #00bfd8">Welcome {{User.name}}</h3>
        </div>
        <div class="text-center" style="font-weight: 700" v-if="User.disable == 1">
            <p class="checks">Your account has been disabled by the Management, contact the Administrator to Re-enable your account</p>
            <div class="card mr-5 mt-5 row">
                <div class=" card mt-sm-2 border m-4 mr-1">
                    <div class="">
                        <div class="m-4 row">
                            <router-link class="" :to="{name:'Profile'}" style="color:#02022c; text-decoration: none;">
                                <div class="row">
                                    <div class="col">
                                        <img v-if="User.avatar" class="card-img-top border" :src='`images/${User.avatar}`' alt="Card image cap" style="height: 150px; width: 150px; border-radius: 10px">
                                        <i v-else-if="User.avatar == null" class="fas fa-user mt-3 text-center" style="font-size: 165px; color: #686363"></i>
                                    </div>
                                    <div class="mt-2">
                                        <div class="m-2">
                                            <h5 class="card-title mt-2" style=" font-weight: 700">{{User.name}} {{User.lastName}}</h5>
                                        </div>
                                        <div class="m-2">
                                            <p class="card-title mt-2" style=" font-weight: 700"> {{User.email}} </p>
                                        </div>
                                        <div class="m-2">
                                            <p v-if="User.post_counts > 1" class="card-title mt-2" style=" font-weight: 700">You have {{User.post_counts}} posts</p>
                                            <p v-if="User.post_counts == 1" class="card-title mt-2" style=" font-weight: 700">You have {{User.post_counts}} post</p>
                                            <p v-if="User.post_counts == 0" class="card-title mt-2" style=" font-weight: 700">You have no post</p>
                                        </div>
                                        <div class="m-2 mt-2"> <small class="">Joined on {{User.created_at}}</small></div>
                                    </div>
                                </div>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class=" card mt-sm-2 border m-4">
                    <div class=" mt-2 ml-4">
                        <div>
                            <div class="row"> Account Status: <div class="text-warning ml-2">Disabled</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center" style="font-weight: 700" v-else-if=" User.paid == null">
            <p class="checks"> You have no post and you can't create any post until you pay 1000Naira
                Click this button below to make payment </p>
            <router-link class="button btn " to="/payment">
                <h4 class="mt-2">Pay</h4>
            </router-link>
            <div class="card mr-5 mt-5 row">
                <div class=" card mt-sm-2 border m-4 mr-1">
                    <div class="">
                        <div class="m-4 row">
                            <router-link class="" :to="{name:'Profile'}" style="color:#02022c; text-decoration: none;">
                                <div class="row">
                                    <div class="col">
                                        <img v-if="User.avatar" class="card-img-top border" :src='`images/${User.avatar}`' alt="Card image cap" style="height: 150px; width: 150px; border-radius: 10px">
                                        <i v-else-if="User.avatar == null" class="fas fa-user mt-3 text-center" style="font-size: 165px; color: #686363"></i>
                                    </div>
                                    <div class="mt-2">
                                        <div class="m-2">
                                            <h5 class="card-title mt-2" style=" font-weight: 700">{{User.name}} {{User.lastName}}</h5>
                                        </div>
                                        <div class="m-2">
                                            <p class="card-title mt-2" style=" font-weight: 700"> {{User.email}} </p>
                                        </div>
                                        <div class="m-2">
                                            <p v-if="User.post_counts > 1" class="card-title mt-2" style=" font-weight: 700">You have {{User.post_counts}} posts</p>
                                            <p v-if="User.post_counts == 1" class="card-title mt-2" style=" font-weight: 700">You have {{User.post_counts}} post</p>
                                            <p v-if="User.post_counts == 0" class="card-title mt-2" style=" font-weight: 700">You have no post</p>
                                        </div>
                                        <div class="m-2 mt-2"> <small class="">Joined on {{User.created_at}}</small></div>
                                    </div>
                                </div>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class=" card mt-sm-2 border m-4">
                    <div class=" mt-2 ml-4">
                        <div>
                            <div class="row"> Account Status: <div class="text-danger ml-2">No payment</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center" style="font-weight: 700" v-else-if="User.paid == 1 && User.activated == null">
            <p class="checks">Your payment has been received, please hold on for the Administrator to activate your account</p> <br />

            <div class="card-mid-pending mr-5 mt-5 row">
                <div class=" card-profile mt-sm-2 border m-4 mr-1">
                    <div class="">
                        <div class="m-4 row">
                            <router-link class="" :to="{name:'Profile'}" style="color:#02022c; text-decoration: none;">
                                <div class="row">
                                    <div class="col">
                                        <img v-if="User.avatar" class="card-img-top border" :src='`images/${User.avatar}`' alt="Card image cap" style="height: 150px; width: 150px; border-radius: 10px">
                                        <i v-else-if="User.avatar == null" class="fas fa-user mt-3 text-center" style="font-size: 165px; color: #686363"></i>
                                    </div>
                                    <div class="mt-2">
                                        <div class="m-2">
                                            <h5 class="card-title mt-2" style=" font-weight: 700">{{User.name}} {{User.lastName}}</h5>
                                        </div>
                                        <div class="m-2">
                                            <p class="card-title mt-2" style=" font-weight: 700"> {{User.email}} </p>
                                        </div>
                                        <div class="m-2">
                                            <p v-if="User.post_counts > 1" class="card-title mt-2" style=" font-weight: 700">You have {{User.post_counts}} posts</p>
                                            <p v-if="User.post_counts == 1" class="card-title mt-2" style=" font-weight: 700">You have {{User.post_counts}} post</p>
                                            <p v-if="User.post_counts == 0" class="card-title mt-2" style=" font-weight: 700">You have no post</p>
                                        </div>
                                        <div class="m-2 mt-2"> <small class="">Joined on {{User.created_at}}</small></div>
                                    </div>
                                </div>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class=" card mt-sm-2 border m-4">
                    <div class=" mt-2 ml-4">
                        <div>
                            <div class="row"> Account Status: <div class="text-warning ml-2">Pending</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center" style="font-weight: 700" v-else-if="posts.length <=0 && User.paid == 1 && User.activated == 1">
            <p class="checks">You have no post click the button below to create your first post</p><br />
            <router-link class="button btn " to="/create">
                <h4 class="mt-2">Create Post</h4>
            </router-link>
            <div class="card mr-5 mt-5 row">
                <div class=" card mt-sm-2 border m-4 mr-1">
                    <div class="">
                        <div class="m-4 row">
                            <router-link class="" :to="{name:'Profile'}" style="color:#02022c; text-decoration: none;">
                                <div class="row">
                                    <div class="col">
                                        <img v-if="User.avatar" class="card-img-top border" :src='`images/${User.avatar}`' alt="Card image cap" style="height: 150px; width: 150px; border-radius: 10px">
                                        <i v-else-if="User.avatar == null" class="fas fa-user mt-3 text-center" style="font-size: 165px; color: #686363"></i>
                                    </div>
                                    <div class="mt-2">
                                        <div class="m-2">
                                            <h5 class="card-title mt-2" style=" font-weight: 700">{{User.name}} {{User.lastName}}</h5>
                                        </div>
                                        <div class="m-2">
                                            <p class="card-title mt-2" style=" font-weight: 700"> {{User.email}} </p>
                                        </div>
                                        <div class="m-2">
                                            <p v-if="User.post_counts > 1" class="card-title mt-2" style=" font-weight: 700">You have {{User.post_counts}} posts</p>
                                            <p v-if="User.post_counts == 1" class="card-title mt-2" style=" font-weight: 700">You have {{User.post_counts}} post</p>
                                            <p v-if="User.post_counts == 0" class="card-title mt-2" style=" font-weight: 700">You have no post</p>
                                        </div>
                                        <div class="m-2 mt-2"> <small class="">Joined on {{User.created_at}}</small></div>
                                    </div>
                                </div>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class=" card mt-sm-2 border m-4">
                    <div class=" mt-2 ml-4">
                        <div>
                            <div class="row"> Account Status: <div class="text-success ml-2">Active</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <!--       <div class="card m-2" v-bind:key="post.id" v-for="post in posts">
                        <div class="row">
                            <div class="">
                                <router-link class="row ml-3" :to="{name:'Userview', params:{id: post.id}}" style="color:#ffff; text-decoration: none;">
                                    <div>
                                        <img class="" v-if="post.image !== 'No image'" :src='`images/${post.image}`' alt="Card image cap" style="height: 200px; width: 200px; border-radius: 100px;">

                                    </div>
                                    <div class=" ">
                                        <h5 class="card-title" style=" font-weight: 700">{{post.title}}</h5>
                                        <p class="card-text">{{post.body}}</p>

                                    </div>
                                </router-link>
                            </div>
                        </div>
                        <div class="">
                            <div class="col dropdown text-right float-right">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Options
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="border-radius: 10px; width: 40px">
                                    <div class="text-center" style="color: #02022c">
                                        <div>
                                            <router-link :to="{name: 'edit', params: {id: post.id}}" style="text-decoration: none; color: #02022c">
                                                <p style="font-weight: 700">Edit</p>
                                            </router-link>
                                        </div>
                                        <div> <a class="btn" style="font-weight: 700;" @click="deletePost(post)">Delete</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=""> <small class="text-white">On {{post.created_at}}</small></div>
                    </div>-->
            <div class="row m-3">
                <div class="col-lg-4 container">
                    <div class="box row m-1">
                        <div style="color: #00bfd8">Your latest Posts</div>
                        <div class="card mt-3" style="color: #00bfd8" v-bind:key="post.id" v-for="post in posts">
                            <div class="row">
                                <div class="col">
                                    <router-link class="" :to="{name:'Userview', params:{id: post.id}}" style="text-decoration: none; color: #00bfd8">
                                        <div>
                                            <img class="m-3" v-if="post.image !== 'No image'" :src='`images/${post.image}`' alt="Card image cap" style="height: 150px; width: 150px; border-radius: 100px">

                                        </div>
                                    </router-link>
                                </div>
                                <router-link class="col-sm  m-3" :to="{name:'Userview', params:{id: post.id}}" style="text-decoration: none; color: #00bfd8">
                                    <div class=" text-white">
                                        <div style="font-size: 30px; font-weight: 700; color: #00bfd8">{{post.title}}</div>
                                    </div>
                                </router-link>
                                <div class="col">
                                    <div class="dropdown text-right float-right">
                                        <button class="btn btn-secondary dropdown-toggle m-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Options
                                        </button>
                                        <div class="dropdown-menu bg-transparent" aria-labelledby="dropdownMenuButton" style="border-radius: 10px; width: 20px">
                                            <div class="text-center" style="color: #02022c">
                                                <div>
                                                    <router-link :to="{name: 'edit', params: {id: post.id}}" style="text-decoration: none; color: #02022c">
                                                        <p style="font-weight: 700">Edit</p>
                                                    </router-link>
                                                </div>
                                                <div> <a class="btn" style="font-weight: 700; margin-top: -10px" @click="deletePost(post)">Delete</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="m-3 text-muted">
                                <div> Created on {{post.created_at}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 container">
                    <div class="mt-1" style="color: #00bfd8">Your Most Viewed Posts</div>
                    <div class="box box-most row mt-lg-2">
                        <div class="card-most text-center m-2" v-bind:key="postview.id" v-for="postview in postviews" style="">
                            <div class="">
                                <div class="">
                                    <router-link class="" :to="{name:'Userview', params:{id: postview.id}}" style="color: #00bfd8; text-decoration: none;">
                                        <div>
                                            <img class="mt-2" v-if="postview.image !== 'No image'" :src='`images/${postview.image}`' alt="Card image cap" style="height: 150px; width: 150px; border-radius: 100px">

                                        </div>
                                        <div class="mt-2">
                                            <h5 class="card-title" style=" font-weight: 700">{{postview.title}}</h5>
                                        </div>
                                        <div class="mt-4"> <small class="text-muted">with {{postview.view -1}} views</small></div>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 container">
                    <div class="box row m-1">
                        <div style="color: #00bfd8">Your Personal Information</div>
                        <div class="card mt-3" style="height: 230px">
                            <div class="">
                                <div class="ml-4">
                                    <router-link class="" to="/profile" style="color:#ffff; text-decoration: none;">
                                        <div class="row">

                                            <img v-if="User.avatar" class="card-img-top border" :src='`images/${User.avatar}`' alt="Card image cap" style="height: 150px; width: 150px; border-radius: 10px">
                                            <i v-else-if="User.avatar == null" class="fas fa-user mt-3 text-center" style="font-size: 165px; color: #686363"></i>

                                            <div class="mt-2">
                                                <div class="m-2">
                                                    <h5 class="card-title mt-2" style=" font-weight: 700; color: #00bfd8">{{User.name}} {{User.lastName}}</h5>
                                                </div>
                                                <div class="m-2">
                                                    <p class="card-title mt-2" style=" font-weight: 700; color: #00bfd8"> {{User.email}} </p>
                                                </div>
                                                <div class="m-2">
                                                    <p v-if="User.post_counts > 1" class="card-title mt-2" style=" font-weight: 700; color: #00bfd8">You have {{User.post_counts}} posts</p>
                                                    <p v-if="User.post_counts == 1" class="card-title mt-2" style=" font-weight: 700; color: #00bfd8">You have {{User.post_counts}} post</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2"> <small class="text-muted">Joined on {{User.created_at}}</small></div>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                        <div class=" card text-center mt-3" style="height: 230px">
                            <div class="" style="font-size: 25px;">
                                <div class="" v-if="User.paid == 1 && User.activated == 1 && User.disable == 0 || User.disable == null && User.post_counts >= 1">
                                    <div class="" style="color: #00bfd8">Account Status <div class="text-success">Active</div>
                                    </div>
                                    <router-link to="/allpost" class="btn button mt-5">
                                        <p class="mt-3">View All Posts</p>
                                    </router-link>
                                </div>
                                <div v-if="User.paid == 1 && User.activated == null && User.disable == null">
                                    <div class="" style="color: #00bfd8">Account Status <div class="text-warning">Pending</div>
                                    </div>
                                </div>
                                <div v-if="User.disable == 1">
                                    <div class="" style="color: #00bfd8"> Account Status <div class="text-warning">>Disabled</div>
                                    </div>
                                </div>
                                <div v-if="User.paid == null">
                                    <div class="" style="color: #00bfd8">Account Status <div class="text-danger">Payment Not Made</div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            postviews: {},

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

        axios.get('/api/auth/me', {
            headers: {
                Authorization: 'Bearer' + localStorage.getItem('token')
            }
        }).then(response => {
            if (response.status == 401) {
                this.$router.push('/login')
            } else {
                this.loaded = true
                localStorage.setItem('User', JSON.stringify(response.data[0]))
                console.log(response.data)
                localStorage.setItem('posts', this.posts = JSON.stringify(response.data[1].data))
                // console.log(response.data[1]).data
                localStorage.setItem('postview', this.postviews = JSON.stringify(response.data[2].data))
                localStorage.setItem('allpost', this.allpost = JSON.stringify(response.data[3]))
                this.User = JSON.parse(localStorage.getItem('User'))
                this.posts = JSON.parse(localStorage.getItem('posts'))
                this.postviews = JSON.parse(localStorage.getItem('postview'))
                this.id = this.User.id
                if (JSON.parse(localStorage.getItem('posts'))) {
                    loader.hide()
                } else {
                    this.$loading.show
                };
            }

        })

    },

    methods: {

        deletePost(post) {
            this.posts.splice(this.posts.indexOf(post), 1)
            axios.delete('/api/auth/posts/' + post.id).then((response) => {
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
.all {
    background: url('./images/contact-background.jpg');
    height: 100%;
}

.here {
    margin: auto;
}

.Username {
    margin: auto;
}

.checks {
    font-size: 20px;
}

.card {
    height: 100%;
    width: 100%;
    background-color: #e8f7f8;
    opacity: 80%;
    border-radius: 10px !important;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    transition: 0.3s;
}

.button {
    text-decoration: none;
    background-color: #00bfd8;
    height: 70px;
    width: 350px;
    opacity: 80%;
    border-radius: 50px !important;
    color: white;
    font-weight: 700;

}

.button:hover {

    background-color: white;
    opacity: 200%;
    transform: scale(1.10) translateZ(0);
    transition-duration: 0.5s;
    transition-timing-function: linear;
    color: #00bfd8 !important;

}

.card-most {
    height: 100%;
    width: 47%;
    background-color: #e8f7f8;
    opacity: 80%;
    border-radius: 10px !important;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    transition: 0.3s;

}

.card-most:hover {
    opacity: 200%;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    transform: scale(1.05) translateZ(0);
    transition-duration: 0.5s;
    transition-timing-function: linear;
}

.card:hover {

    opacity: 200%;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    transform: scale(1.05) translateZ(0);
    transition-duration: 0.5s;
    transition-timing-function: linear;
}

@media screen and (max-width: 600px) {
    .card {
        width: 100% !important;

    }

    .card-most {
        width: 100% !important;

    }

    .button {

        width: 250px;

    }

    .box-most {
        margin: 0px;
    }
}
</style>
