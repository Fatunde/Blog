<template>
<div>
    <nav class="navbar navbar-expand-md navbar-default width: 100% fixed-top">

        <a class="navbar-brand ml-lg-5">
            <h3 style="font-weight: 700;" class="nav-link">Management</h3>
        </a>
        <button class="navbar-toggler mr-3" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <i class="fas fa-bars" style="color: #00bfd8;"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto" style="">
                <li class="nav-item ml-lg-5"><a class="nav-link" style="" href="/">
                        Home
                    </a></li>
                <li class="nav-item ml-lg-5">
                    <router-link to="/index" class="nav-link" style="text-decoration:none;">
                        Blog
                    </router-link>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <li class="nav-item-aut mr-lg-5">
                    <router-link to="/login" class="nav-link" style="">
                        Login
                    </router-link>
                </li>
                <li class="nav-item-aut mr-lg-5">
                    <router-link to="/register" class="nav-link" style="">
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
$(window).scroll(function () {
    $('nav').toggleClass('scrolled', $(this).scrollTop() > 50);
    $('li').toggleClass('scrolling', $(this).scrollTop() > 50);
});
</script>

<style scoped>
.navbar-default {
    transition: 500ms ease;
    background: transparent;
}

.navbar-default.scrolled {
    background: #fff;
}

nav {
    background-color: #fff;
}

li {
    font-weight: 700;
}

.nav-link {
    color: #00bfd8;
}

.nav-item-aut {
    color: #fff;
}

.nav-item-aut.scrolling {
    color: #00bfd8
}

li {
    font-weight: 700;
}
</style>
