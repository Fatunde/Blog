<template>
<div>
    <DashboardNavbar />

    <section>

        <div class="mt-5 ml-5 recent">
            all your posts
        </div>
        <div class="row  ml-5">

            <div class="card" v-bind:key="post.id" v-for="post in posts">
                <router-link :to="{name:'Userview', params:{id: post.id}}" style="color: black; text-decoration: none;">
                    <img v-if="post.image !== 'No image'" class="card-img-top" :src='`images/${post.image}`' alt="Card image cap" style="height: 300px; border-radius: 10px 10px 0px 0px">
                    <div class="card-body">
                        <div class="row">
                            <h5 class="card-title ml-3">{{post.title}}</h5>
                        </div>
                        <p class="card-text">{{post.body}}</p>

                    </div>
                </router-link>
                <div class="col dropdown text-right float-right">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Options
                    </button>
                    <div class="dropdown-menu " aria-labelledby="dropdownMenuButton" style="border-radius: 10px; width: 40px">
                        <div class="text-center  m-auto" style="color: #02022c">
                            <div>
                                <router-link :to="{name: 'edit', params: {id: post.id}}" style="text-decoration: none; color: #02022c">
                                    <p style="font-weight: 700">Edit</p>
                                </router-link>
                            </div>
                            <div> <a class="btn" style="font-weight: 700; margin-top: -20px" @click="deletePost(post)">Delete</a></div>
                        </div>
                    </div>
                </div>
                <small class="text-muted ml-3 mb-2 mt-2">By You on {{post.created_at}}</small>
            </div>

        </div>
    </section>

</div>
</template>

<script>
import axios from 'axios';
import DashboardNavbar from '../DashboardNavbar';

export default {

    components: {
        DashboardNavbar
    },

    data() {

        return {
            User: {},

            image_src: '../../public/images',

            posts: [],

            post: {
                id: "",
                title: "",
                body: "",
                updated_at: "",
            },
            image: "",
            posts: {},
            pagination: {},
            paginator: {},
            Users: {}

        }
    },
    created() {

        axios.get('/auth/me', {
            headers: {
                Authorization: 'Bearer' + localStorage.getItem('token')
            }
        }).then(response => {

            console.log(response.data[3])
            if (response.status == 401) {
                this.$router.push('/login')
            } else {
                this.loaded = true

                localStorage.setItem('allpost', this.posts = JSON.stringify(response.data[3]))

                this.posts = JSON.parse(localStorage.getItem('allpost'))
                if (JSON.parse(localStorage.getItem('allpost'))) {
                    loader.hide()
                } else {
                    this.$loading.show
                };
            }

            axios.get('/auth/my', {
                headers: {
                    Authorization: 'Bearer' + localStorage.getItem('token')
                }
            }).then(response)
        }).catch(error => {
            this.loginError = true
        });

    },
    methods: {
        deletePost(post) {
            this.posts.splice(this.posts.indexOf(post), 1)
            axios.delete('/auth/posts/' + post.id).then((response) => {
                    console.log(response)
                }

            ).catch(error => {
                console.log(error)
            })
        }
    }

}

/*Relationships between user and post in vue and laravel
 *Relationships in laravel
 */
</script>

<style scoped>
.pagination {
    margin: auto;
}

.recent {
    color: #00008B;
    font-size: 25px;
    font-weight: 700;
}

h3 {
    margin: auto;
    color: #00008B;
    font-weight: 700;

}

p {
    color: #00008B;
    font-weight: bold;
    margin-bottom: 40px
}

.card {
    margin: 10px;
    height: 100%;
    width: 300px;
    margin-top: 50px;
    background-color: white;
    opacity: 80%;
    border-radius: 10px !important;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    transition: 0.3s;
}

.card:hover {

    opacity: 200%;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    transform: scale(1.05) translateZ(0);
    transition-duration: 0.5s;
    transition-timing-function: linear;
}
</style>
