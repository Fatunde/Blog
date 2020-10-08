import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'


Vue.use(Vuex)





export default new Vuex.Store({
    state: {
        isLoggedIn: !!localStorage.getItem('token'),
        user: localStorage.getItem('User'),
        posts: localStorage.getItem('posts'),
        post: localStorage.getItem('post')
    },
    actions: {
        
        deletePost({commit}, id) {
            axios.delete('/auth/posts/' + id).then(()=>{

                commit('deletePost', id)
            }).catch(error => {
                console.log(error)
            })
        }
    },
    
    mutations: {
     
        loginUser (state) {
            state.isLoggedIn = true
        },
        logoutUser (state) {
            state.isLoggedIn = false
        },
        deletePost(state, id){
          let  curretPost = JSON.parse(state.posts)
           let index = curretPost.findIndex(post => post.id == id)
            curretPost.splice(index, 1)
           }
    }
})