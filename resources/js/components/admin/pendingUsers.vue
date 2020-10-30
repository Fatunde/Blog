<template>
<div class="">
    <adminNavbar />
    <div class="row">
        <div class="card-body card mt-3 rounded col-lg-2" v-bind:key="User.id" v-for="User in Users">
            <img class="card-img-top" :src='`images/${User.avatar}`' alt="Card image cap" style="height: 300px; border-radius:200px;">
            <h5>First Name: {{User.name}}</h5>
            <h5>Last Name: {{User.lastName}}</h5>
            <p>Email: {{User.email}}</p>
            <small>Joined on: {{User.created_at}}</small>
            <p class="mt-4">
                <button class="btn btn-danger" @click="deleteUser( User)">Reject User</button>
                <button class="btn btn-success" @click="approveUser( User)">Approve User</button>
            </p>

        </div>
    </div>

</div>
</template>

<script>
import axios from 'axios';
import adminNavbar from './adminNavbar';

export default {
    components: {
        adminNavbar
    },

    data() {
        return {
            activated: true,
            Users: [],
            posts: [],

            User: {
                name: "",
                id: this.id,
                created_at: "",
                lastName: "",
                avatar: ""
            },

            post: {
                id: "",
                title: "",
                body: "",
                created_at: ""
            },
            post_id: "",
            pagination: {},
            edit: false,
            disable: true,
        }

    },

    mounted() {
        axios.get('/auth/activated', {
                headers: {
                    Authorization: 'Bearer' + localStorage.getItem('token')
                }
            })
            .then(response => {

                this.Users = response.data

                console.log(this.Users)

            })

    },

    methods: {
        deleteUser(User) {
            this.Users.splice(this.Users.indexOf(User), 1).then(
                axios.put('/auth/disable/' + User.id, {
                    disabled: this.disabled,

                }).then(
                    console.log("User Deleted")
                ).catch(error => {
                    console.log(error)
                }))
        },

        approveUser(User) {
            this.Users.splice(this.Users.indexOf(User), 1).then(
                axios.put('auth/activate' + User.id, {
                    activated: this.activated
                }).then(response => {
                    console.log(response)
                }))
        }
    },

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
