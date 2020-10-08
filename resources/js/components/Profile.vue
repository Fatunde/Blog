<template>
<div>
    <DashboardNavbar />

    <div class="card mt-3  card-body rounded " v-bind:key="User.id">

        <router-link to="/profilepicture"> <img class="card-img-top" :src='`images/${User.avatar}`' alt="Card image cap" style="height: 300px; border-radius:200px;"></router-link>
        <h5 class="mt-5" style="font-weight: 700">Name: {{User.name}} {{User.lastName}}</h5>
        <h5 class="mt-5" style="font-weight: 700">Email: {{User.email}}</h5>
        <h5 class="mt-5" style="font-weight: 700">No of Posts: {{posts.length}}</h5>
        <div class="text-center mt-5">
            <router-link to="/updateprofile" class="btn button" style="font-weight: 700" v-if="User.disable == 0 || User.disable == null">
                <p class="mt-2">Edit Your Profile</p>
            </router-link>
        </div>

    </div>
</div>
</template>

<script>
import axios from 'axios';
import DashboardNavbar from "./DashboardNavbar";

export default {
    components: {
        DashboardNavbar
    },

    mounted() {
        axios.get('/auth/me', {
                headers: {
                    Authorization: 'Bearer' + localStorage.getItem('token')
                }
            })
            .then(response => {
                this.User = response.data[0].original
                this.posts = response.data[0].original.posts
                this.id = this.User.id

                console.log(this.User)

            })

    },
    data() {

        return {
            User: {
                name: "",
                email: "",
                lastName: ""

            },
            posts: []
        }
    },

}
</script>

<style scoped>
.card {
    color: #00008B;
    margin: auto;
    width: 350px;
    height: 100%;
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

.button {
    width: 190px;
    height: 60px;
    background-color: #00008B;
    border: none !important;
    outline: none !important;
    border-radius: 5px;
    color: white;

}

.button:hover {
    color: #00008B;
    background-color: white;
}
</style>
