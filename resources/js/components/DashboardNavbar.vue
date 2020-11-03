<template>
<div>

    <nav class="navbar navbar-expand-md navbar-light shadow-sm">

        <a class="navbar-brand ml-lg-5">
            <h3 style="color: #00008B; font-weight: 700;">Management</h3>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ml-lg-5">
                    <router-link to="/dashboard" class="nav-link" style="color: #00008B; font-weight: 700;">
                        Dashboard
                    </router-link>
                </li>
                <li class="nav-item ml-lg-5">
                    <router-link to="/userblog" class="nav-link" style="color: #00008B; font-weight: 700;">
                        Blog
                    </router-link>
                </li>
                <li class="nav-item ml-lg-5">
                    <router-link to="/pending" class="nav-link" style="color: #00008B; font-weight: 700;">
                        Status
                    </router-link>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->

                <li class="nav-item dropdown mr-lg-5">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #00008B; font-weight: 700;">
                        {{User.name}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <button @click="payCreate" class="nav-link btn btn-white" style="color: #00008B; font-weight: 700;">Create post</button>
                        <router-link to="/profile" class="nav-link" style="color: #00008B; font-weight: 700;">View Profile</router-link>
                        <button @click="logOut" class="nav-link btn btn-white" style="color: #00008B; font-weight: 700;">Log out</button>
                    </div>
                </li>
            </ul>
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
            paid: ""

        }
    },
    mounted() {
        axios.get('/api/auth/me', {
                headers: {
                    Authorization: 'Bearer' + localStorage.getItem('token')
                }
            })
            .then(response => {
                this.User = response.data[0].original
                this.posts = response.data[0].original.posts
                this.paid = response.data[0].original.paid
                this.activated = response.data[0].original.activated
                this.id = this.User.id

            })

    },
    methods: {
        payCreate() {
            if (this.paid == null) {
                this.$router.push('/payment')
            } else if (this.paid == 1 && this.activated == null) {
                this.$router.push('/pending')
            } else if (this.paid == 1 && this.activated == 1) {
                this.$router.push('/create')
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
.nav-link {
    color: #00008B;
}

.navbar-toggler {
    background-color: white;
}

button {
    font-weight: 700;
}
</style>
