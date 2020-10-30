<template>
<div>
    <nav class="navbar navbar-expand-md navbar-light shadow-sm width: 100%">

        <a class="navbar-brand ml-lg-5">
            <h3 style="color: #00008B; font-weight: 700;">Management</h3>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto" style="color: #00008B">
                <li class="nav-item ml-lg-5"><a class="nav-link" style="color: #00008B" href="/">
                        Home
                    </a></li>
                <li class="nav-item ml-lg-5">
                    <router-link to="/about" class="nav-link" style="color: #00008B; text-decoration:none;">
                        About Us
                    </router-link>
                </li>
                <li class="nav-item ml-lg-5">
                    <router-link to="/index" class="nav-link" style="color: #00008B; text-decoration:none;">
                        Blog
                    </router-link>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <li class="nav-item mr-lg-5">
                    <router-link to="/login" class="nav-link " style="color: #00008B">
                        Login
                    </router-link>
                </li>
                <li class="nav-item mr-lg-5">
                    <router-link to="/register" class="nav-link" style="color: #00008B">
                        Register
                    </router-link>
                </li>

                <li class="nav-item dropdown">

                </li>
            </ul>
        </div>

    </nav>
</div>
</template>

<script>
import store from "../store"
export default {
    data() {
        return {
            Navbar,
            store
        }
    },

    computed: {
        loggedIn() {
            return store.state.isLoggedIn
        }
    },
}
</script>

<style scoped>
nav {
    color: #00008B;
}

.nav-link {
    color: #00008B;
}

li {
    font-weight: 700;
}
</style>
