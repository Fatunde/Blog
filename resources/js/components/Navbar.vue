<template>
<div>
    <nav class="navbar navbar-expand-md navbar-light shadow-sm">

        <a class="navbar-brand" href="/">
            <h3 style="color: #00008B; font-weight: 700;">Management</h3>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse mt-3 " id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto" style="color: #00008B">
                <li class="nav-item"><a class="nav-link" style="color: #00008B" href="/">
                        <p>Home</p>
                    </a></li>
                <li class="nav-item">
                    <router-link to="/about" class="nav-link" style="color: #00008B; text-decoration:none;">
                        <p>About Us</p>
                    </router-link>
                </li>
                <router-link to="/index" class="nav-link" style="color: #00008B; text-decoration:none;">
                    <p>Blog</p>
                </router-link>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <li class="nav-item">
                    <router-link to="/login" class="nav-link " style="color: #00008B">
                        <p>Login</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/register" class="nav-link" style="color: #00008B">
                        <p>Register</p>
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

p {
    font-weight: 700;
}
</style>
