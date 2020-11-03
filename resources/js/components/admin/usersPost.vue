<template>
<div>
    <adminNavbar />

    <div class="card-body card mt-3 rounded" v-bind:key="post.id" v-for="post in posts">
        <router-link :to="{name:'Postview', params:{id: post.id}}" style="color: black; text-decoration: none">
            <div class="row">
                <div class="col">
                    <h3>{{post.title}}</h3>
                </div>
                <div class="col"> <button class="btn btn-danger ml-auto" @click="deletePost(post)">Delete Post</button>
                </div>
            </div>

            <p>By {{post.user_name}}</p>
            <small>On {{post.created_at}}</small>
        </router-link>
    </div>

</div>
</template>

<script>
import axios from 'axios';
import adminNavbar from './adminNavbar.vue';

export default {

    components: {
        adminNavbar
    },

    data() {
        return {

            User: {
                name: "",
                email: ""
            },

            posts: [],

            post: {
                id: "",
                title: "",
                body: "",
                updated_at: "",
            },

        }
    },
    mounted() {
        axios.get('/api/auth/admin', {
                headers: {
                    Authorization: 'Bearer' + localStorage.getItem('token')
                }
            })
            .then(response => {

                this.Users = response.data
                this.pos = response.data[0].posts

                console.log(this.Users)

                // console.log(this.posts)

            })

    },
    created() {
        axios.get('/api/auth/posts').then(response => {
            this.posts = response.data.data

        }).catch(error => {
            this.loginError = true
        })

    },
    methods: {
        show() {

            this.$router.push('/show')

        },

        deletePost(post) {
            this.posts.splice(this.posts.indexOf(post), 1)
            axios.delete('/api/auth/posts/' + post.id).then((response) => {
                    console.log(response)
                }

            ).catch(error => {
                console.log(error)
            })
        }
    }
}
</script>

<style scoped>
h3 {
    margin: auto;
    color: #00008B;
    font-weight: 700;

}

p {
    color: #00008B;
    font-weight: bold;
    margin-bottom: 40px
}

.card {
    margin: 10px;
    height: 100%;
    width: 350px;
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
</style>
