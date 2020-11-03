
import Vue from 'vue';
import Vuex from 'vuex';
import store from './components/store';
import VueRouter from 'vue-router';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'


Vue.use(BootstrapVue)

Vue.use(IconsPlugin)

Vue.use(VueRouter);


import App from './App.vue';
Vue.use(VueAxios, axios);



import VueAxios from 'vue-axios';
import axios from 'axios';
import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);



 Vue.use(Vuex)




import adminDashboard from './components/admin/adminDashboard.vue'
import adminLogin from './components/admin/adminLogin.vue'
import adminNavbar from './components/admin/adminNavbar.vue'
import users from './components/admin/users.vue'
import usersPost from './components/admin/usersPost.vue'
import usersProfile from './components/admin/usersProfile.vue'
import Navbar from './components/Navbar'
import Home from './components/Home.vue'
import login from './components/auth/login.vue'
import success from './components/auth/success.vue'
import Register from './components/auth/Register.vue'
import Create from './components/post/create.vue'
import Edit from './components/post/edit.vue'
import userView from './components/post/userview.vue'
import allpost from './components/post/allpost.vue'
import Show from './components/post/show.vue'
import Index from './components/post/index.vue'
import userblog from './components/post/userblog'
import Dashboard from './components/Dashboard.vue'
import DashboardNavbar from './components/DashboardNavbar.vue'
import Profile from './components/Profile.vue'
import Payment from './components/Payment.vue'
import Loading from './components/Loading.vue'
import pending from './components/pending.vue'
import pendingUsers from './components/admin/pendingUsers'
import UpdateProfile from './components/UpdateProfile.vue'
import Profileupdatesuccess from './components/Profileupdatesuccess'
import Paymentsuccess from './components/Paymentsuccess'
import postView from './components/admin/postView.vue'
import About from './components/About.vue'
import Profilepicture from './components/Profilepicture.vue'
import ForgotPassword from './components/ForgotPassword.vue'
import ResetPasswordForm from './components/ResetPasswordForm.vue'


axios.defaults.baseURL = 'http://localhost:8000/api';

const routes = [
    {
        path: '/About',
        name: "About",
        component: About
    },
    {
        path: '/profileupdatesuccess',
        name: "Profileupdatesuccess",
        component: Profileupdatesuccess,
        meta: { requiresAuth: true }
    },
    {
        path: '/postview',
        name: "Postview",
        component: postView,
        meta: { requiresAuth: true }
    },
    {
        path: '/paymentsuccess',
        name: "Paymentsuccess",
        component: Paymentsuccess,
        meta: { requiresAuth: true }
    },
    {
        path: '/admin',
        name: "Admin",
        component: adminLogin,
        meta: { requiresAuth: true }
    },
    {
        path: '/pendingusers',
        name: "Pendingusers",
        component: pendingUsers,
        meta: { requiresAuth: true }
    },
    { 
        path: '/reset-password', 
        name: 'reset-password', 
        component: ForgotPassword, 
        meta: { 
            requiresAuth: false 
        } 
      },
      { 
        path: '/reset-password/:token', 
        name: 'reset-password-form', 
        component: ResetPasswordForm, 
        meta: { 
            requiresAuth: false 
        } 
      },
    {
        path: '/allpost',
        name: 'Allpost',
        component: allpost,
        meta: { requiresAuth: true }
    },
    {
        path: '/updateprofile',
        name: "UpdateProfile",
        component: UpdateProfile,
        meta: { requiresAuth: true }
    },
    {
        path: '/pending',
        name: "Pending",
        component: pending,
        meta: { requiresAuth: true }
    },
    {
        path: '/userview',
        name: "Userview",
        component: userView,
        meta: { requiresAuth: true }
    },
    {
        path: '/success',
        name: "Success",
        component: success,
        
    },
    {
        path: '/adminnavbar',
        name: "Adminnavbar",
        component: adminNavbar,
        meta: { requiresAuth: true }
    },
    {
        path: '/users',
        name: "users",
        component: users,
        meta: { requiresAuth: true }
    },
    {
        path: '/loading',
        name: "loading",
        component: Loading,
        
    },
    {
        path: '/userspost',
        name: "Userspost",
        component: usersPost,
        meta: { requiresAuth: true }
    },
    {
        path: '/usersProfile',
        name: "Usersprofile",
        component: usersProfile,
        meta: { requiresAuth: true }
    },
    {
        path: '/admin/dashboard',
        name: "adminDashboard",
        component: adminDashboard,
        meta: { requiresAuth: true }
    },
    {
        path: '/',
        name: "Home",
        component: Home,
        
    },
    {
        path: '/Navbar',
        name: "Navbar",
        component: Navbar,
       
    },
    {
        path: '/Show',
        name: "Show",
        component: Show,
       
    },
    {
        path: '/Index',
        name: "Index",
        component: Index,
       
    },
    {
        path: '/profilepicture',
        name: "Profilepicture",
        component: Profilepicture,
        meta: { requiresAuth: true }
    },
    
    {
        path: '/Dashboard',
        name: "Dashboard",
        component: Dashboard,
        meta: { requiresAuth: true }
    },
    {
        path: '/login',
        name: "Login",
        component: login,
        
    },
    {
        path: '/register',
        name: "Register",
        component: Register,
       
    },
    {
        path: '/create',
        name: "Create",
        component: Create,
        meta: { requiresAuth: true }
    },
    {
        path: '/edit',
        name: "edit",
        component: Edit,
        meta: { requiresAuth: true }
    },
     {   path: '/DashboardNavbar',
        name: 'dashboardNavbar',
        component: DashboardNavbar,
        mata: { requiresAuth: true }
    },
    {   path: '/profile',
        name: 'Profile',
        component: Profile,
        mata: { requiresAuth: true }
    },
    {
        path: '/payment',
        name: 'Payment',
        component: Payment,
        meta: { requiresAuth: true }
    },
    {
        path: '/userblog',
        name: 'Userblog',
        component: userblog,
        meta: { requiresAuth: true }
    }
];  



const router = new VueRouter({ mode: 'history', routes: routes, store});
router.beforeEach((to, from, next) => {

    // check if the route requires authentication and user is not logged in
    if (to.matched.some(route => route.meta.requiresAuth) && !store.state.isLoggedIn) {
        // redirect to login page
        next('/login')
        return
    }
    next()
})



const app = new Vue(Vue.util.extend({ router } , App, store)).$mount('#app');