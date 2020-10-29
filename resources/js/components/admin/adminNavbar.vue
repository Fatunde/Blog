<template>
<div>

    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">
                <h3 class="mr-5">Management</h3>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <router-link to="/users" class="nav-link">
                        <p>Manage Users</p>
                    </router-link>
                    <router-link to="/userspost" class="nav-link">
                        <p>Posts</p>
                    </router-link>
                    <div class="row ml-1">
                        <router-link to="/pendingusers" class="nav-link">
                            <p>Pending users</p>
                        </router-link>

                        <div class="row" v-if="Pending_users"> <i class="fas fa-bell text-danger" style="margin-top: 10px; margin-left: 6px; font-size: 23px;">
                            </i>
                            <div class="text-white" style="margin-top: 9px; margin-left: -15px">{{Pending_users}}</div>
                        </div>
                    </div>

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" style="color: #00008B; font-weight: 700" aria-haspopup="true" aria-expanded="false">
                            Admin
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                            <button @click="logOut" class="nav-link btn btn-white" style="color: #00008B; font-weight: 700">Log out</button>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
</div>
</template>

<script>
import axios from 'axios';
import store from '../store'

export default {
    data() {
        return {

            User: {
                name: "",
                id: this.id,
                created_at: ""
            },
            paid: "",
            Pending_users: ""

        }
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
                this.paid = response.data[0].original.paid
                this.id = this.User.id

            }),
            axios.get('/auth/activated', {
                headers: {
                    Authorization: 'Bearer' + localStorage.getItem('token')
                }
            })
            .then(response => {

                this.Pending = response.data
                this.Pending_users = this.Pending.length
                console.log(this.Pending_users)

            })

    },
    methods: {
        payCreate() {
            if (this.paid == 1) {
                this.$router.push('/create')
            } else if (this.paid == null) {
                this.$router.push('/payment')
            }
        },

        logOut() {
            localStorage.removeItem('token')
            store.commit('logoutUser')
            this.$router.push({
                name: "Login"
            })
        }
    }
}
</script>

<style scoped>
.pending {
    margin-left: -10px;
    font-weight: 700;
    margin-top: 10px;
}

nav {
    color: #00008B;
}

h3 {
    color: #00008B;
    font-weight: 700;
}

.nav-link {
    color: #00008B;
}

p {
    margin-top: 10px;
    font-weight: 700;
    color: #00008B
}
</style>
