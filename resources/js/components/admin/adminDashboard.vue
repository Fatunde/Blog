<template>
<div class="container">
    <adminNavbar />
    <div class="box text-center mt-5 ">
        <h3 class="">You are an Administrator</h3>
        <marquee>
            <h6>You can manage users and posts here</h6>
        </marquee>
    </div>
</div>
</template>

<script>
import axios from 'axios';
import adminNavbar from './adminNavbar';

export default {
    components: {
        adminNavbar
    },

    data() {
        return {
            Users: [],
            posts: [],

            User: {
                name: "",
                id: this.id,
                created_at: ""
            },

            post: {
                id: "",
                title: "",
                body: "",
                created_at: ""
            },
            post_id: "",
            pagination: {},
            edit: false,
            Pending_users: {}
        }

    },

    mounted() {
        axios.get('/auth/admin', {
                headers: {
                    Authorization: 'Bearer' + localStorage.getItem('token')
                }
            })
            .then(response => {

                this.Users = response.data
                this.posts = response.data[0].posts

                console.log(this.Users)
                console.log(this.posts)

            })

    },

    methods: {

        deletePost(id) {
            axios.delete('/auth/posts/' + id).then(
                console.log("Post Deleted")
            ).catch(error => {
                console.log(error)
            })
        }
    },

}
</script>
