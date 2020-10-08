<template>
<div class="container">
    <adminNavbar />

    <div class="card-body card mt-3 rounded text-center " v-bind:key="User.id" v-for="User in Users">
        <div class="dropdown text-right">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Options
            </button>
            <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">
                <div class="mt-3"> <a class="btn" style="color: #00008B" @click="deleteUser( User)">Delete User</a></div>
                <div v-if="User.disable == 0 || User.disable == null" class="mt-3"> <a class="btn" style="color: #00008B" @click="disableUser( User)">Disable User</a></div>
                <div class="mt-3" v-if="User.disable == 1"> <a class="btn" style="color: #00008B" @click="enableUser( User)">Enable User</a></div>
                <div class="mt-3">

                </div>
            </div>
        </div>

        <h5 class="mt-5">First Name: {{User.name}}</h5>
        <h5 class="mt-5">Last Name:{{User.lastName}}</h5>
        <p class="mt-5">Email: {{User.email}}</p>
        <router-link :to="{name:'Usersprofile', params:{id: User.id}}" class="btn btn-primary posting" style="text-decoration: none; ">
            <p class="text-white mt-2">User's Posts</p>
        </router-link>

        <small class="mt-5">Created at: {{User.created_at}}</small>

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
            Users: [],
            posts: [],

            User: {
                name: "",
                id: this.id,
                created_at: ""
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
            disabled: true,
            enabled: false,

        }

    },

    mounted() {
        axios.get('/auth/admin', {
                headers: {
                    Authorization: 'Bearer' + localStorage.getItem('token')
                }
            })
            .then(response => {
                localStorage.setItem('Users', JSON.stringify(response.data))
                localStorage.setItem('posts', JSON.stringify(response.data[0].posts))

                this.Users = JSON.parse(localStorage.getItem('Users'))
                this.posts = JSON.parse(localStorage.getItem('posts'))

                console.log(this.Users)
                console.log(this.posts)

            })

    },

    methods: {
        deleteUser(User) {
            this.Users.splice(this.Users.indexOf(User), 1).then(
                axios.delete('/auth/user' + User.id, {
                    headers: {
                        Authorization: 'Bearer' + localStorage.getItem('token')
                    }
                }).then(
                    console.log("User Deleted")
                ).catch(error => {
                    console.log(error)
                })
            )
        },
        disableUser(User) {
            axios.put('/auth/disable' + User.id, {
                disabled: this.disabled,

            }).then(
                console.log("User Disabled")
            ).catch(error => {
                console.log(error)
            })
        },
        enableUser(User) {
            axios.put('/auth/enable' + User.id, {
                enabled: this.enabled,

            }).then(
                console.log("User enabled")
            ).catch(error => {
                console.log(error)
            })
        }
    },

}
</script>

<style scoped>
.posting {
    height: 60px;
    background-color: #00008B;
    font-weight: 700;
    border: 20px;
}

h5 {
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
    width: 370px;
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
