<template>
<div>
    <Navbar />
    <div>
        <div class="card-body card mt-3 rounded row-lg" style="height: 100%; font-weight: 700" v-bind:key="post.id">
            <img class="card-img-top" :src='`images/${post.image}`' alt="Card image cap" style="height: 300px">
            <div class="row-lg text-center" style="color: #00008B">
                <h3 class="mb-5" style="font-weight: 700; ">{{post.title}}</h3>
                <p class="mt-5 mb-5"> {{post.body}}</p>
                <small class="text-muted">On {{post.created_at}} by {{post.user_name}}</small>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';
import Navbar from "../Navbar";
import store from "../store";

export default {
    components: {
        Navbar
    },

    data() {

        return {
            post: {
                title: "",
                body: "",
                created_at: ""
            },

        }
    },

    mounted() {

        let id = this.$route.params.id;

        axios.get('/auth/posts/' + id)
            .then(response => {

                localStorage.setItem("post", JSON.stringify(response.data))
                this.post = JSON.parse(localStorage.getItem('post'))
            })
            .catch(function (error) {
                console.log(error)
            });

        axios.put('/auth/read' + id)
            .then(response => {
                console.log(response)
            })
            .catch(function (error) {
                console.log(error)
            });
    },

}
</script>

<style scoped>
.card {
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
</style>
