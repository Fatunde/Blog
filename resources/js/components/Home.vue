<template>
<div>
    <Navbar />

    <div class="jumbotron container  text-center">
        <h1 class="display-4" style="color: #00008B; font-weight: 700">Welcome</h1>
        <p class="lead">This is a Platform where you can create to have fun</p>

        <p class="">Creating of post is made easy with just little price</p>

        <router-link class="button btn" to="/about">
            <p class="mt-3">Click here to get started</p>
        </router-link>

    </div>

</div>
</template>

<script>
import Navbar from './Navbar'
export default {
    name: 'login',
    components: {
        Navbar
    },

}
</script>

<style scoped>
.button {
    text-decoration: none;
    background-color: #00008B;
    height: 70px;
    width: 250px;
    opacity: 80%;
    border-radius: 50px !important;
    color: white;
    text-align: center;

}

p {
    color: #00008B;
    font-weight: 700;
}

.button:hover {

    background-color: white;
    opacity: 200%;
    transform: scale(1.10) translateZ(0);
    transition-duration: 0.5s;
    transition-timing-function: linear;
    color: #00008B !important;

}

.button p {
    color: white;
    font-weight: 700;
}

.button p:hover {
    color: #00008B;
}

.link {
    color: white;
}

.link:hover {
    color: black
}
</style>
