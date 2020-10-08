import Vue from 'vue'
import Vuex from 'vuex'



Vue.use(Vuex)



export default new Vuex.Store({
    state: {
        isLoggedIn: !!localStorage.getItem('token'),
        user: localStorage.getItem('User'),
        posts: localStorage.getItem('posts'),
        post: localStorage.getItem('post')
    },
    mutations: {
     
        loginUser (state) {
            state.isLoggedIn = true
        },
        logoutUser (state) {
            state.isLoggedIn = false
        },
        deletePost(state, post){
            let id = state.posts.indexOf(post)
            state.posts.splice(id, 1)
        },
        showPost(state){
           let post = state.post
           state.post.push(post)

        }
    }
})