import Vue from 'vue'
import Router from 'vue-router'
import Navbar from '../components/Navbar'
import Home from '../components/Home.vue'
import Login from '../components/auth/Login.vue'
import Register from '../components/auth/Register.vue'
import Createpost from '../components/post/create.vue'
import Editpost from '../components/post/edit.vue'
import Show from '../components/post/show.vue'

Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: "Home",
            component: Home
        },
        {
            path: '/Navbar',
            name: "Login",
            component: Navbar
        },
        {
            path: '/login',
            name: "Login",
            component: Login
        },
        {
            path: '/register',
            name: "Register",
            component: Register
        },
        {
            path: '/create',
            name: "Createpost",
            component: Createpost
        },
        {
            path: '/edit',
            name: "Editpost",
            component: Editpost
        },
        {
            path: '/show',
            name: "Show",
            component: Show
        },
    ]
})