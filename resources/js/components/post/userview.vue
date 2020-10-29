<template>
<div>
    <DashboardNavbar />
    <div>

        <div class="card-body card mt-3 rounded row-lg" style="height: 100%; " v-bind:key="post.id">
            <img class="card-img-top" :src='`images/${post.image}`' alt="Card image cap" style="height: 300px">
            <div class="row-lg text-center" style="color: #00008B">
                <h3 class="mb-2">{{post.title}}</h3>
                <p class="mt-5 mb-5">{{post.body}}</p>
                <div v-if="User.name == post.user_name">
                    <small class="text-muted">On {{post.created_at}} by You</small>
                </div>
                <div v-else>
                    <small class="text-muted">On {{post.created_at}} by {{post.user_name}}</small>
                </div>

            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';
import DashboardNavbar from "../DashboardNavbar";

export default {
    components: {
        DashboardNavbar
    },

    mounted() {

        let id = this.$route.params.id;

        axios.get('/auth/posts/' + id)
            .then(response => {

                localStorage.setItem("post", JSON.stringify(response.data))
                this.post = JSON.parse(localStorage.getItem("post"))
            })
            .catch(function (error) {
                console.log(error)
            });
        this.User = JSON.parse(localStorage.getItem('User'))
        this.posts = JSON.parse(localStorage.getItem("post"))
        console.log(this.User.id)
        console.log(this.posts.user_id)
        if (this.User.id != this.posts.user_id) {
            axios.put('/auth/read' + id)
                .then(response => {
                    console.log(response)
                })
                .catch(function (error) {
                    console.log(error)
                })
        };
    },
    data() {

        return {
            post: {
                title: "",
                body: "",
                created_at: ""
            },
            User: {}
        }
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
            this.User = JSON.parse(localStorage.getItem('User'))
            axios.put('/auth/read' + id)

        }
    },

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

.card {
    height: 100%;
    margin: auto;
    width: 300px;
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

button {
    text-decoration: none;
    background-color: red;
    height: 70px;
    width: 250px;
    opacity: 80%;
    border-radius: 50px !important;
    color: white;
    text-align: center;
    font-weight: 700;
}

.button {
    text-decoration: none;
    background-color: #00008B;
    height: 70px;
    width: 250px;
    opacity: 80%;
    border-radius: 50px !important;
    color: white;
    text-align: center;
    font-weight: 700;
}
</style>
