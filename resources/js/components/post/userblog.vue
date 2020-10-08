<template>
<div>
    <DashboardNavbar />

    <section>

        <div class="mt-5 ml-lg-5 recent">
            Most read blogs
        </div>
        <div class="row  ml-5">

            <div class="card" v-bind:key="read.id" v-for="read in reads">
                <router-link :to="{name:'Userview', params:{id: read.id}}" style="color: black; text-decoration: none;">
                    <img class="card-img-top" :src='`images/${read.image}`' alt="Card image cap" style="height: 300px">
                    <div class="card-body">
                        <h5 class="card-title">{{read.title}}</h5>
                        <p class="card-text">{{read.body}}</p>
                        <small class="text-muted">By {{read.user_name}} on {{read.created_at}}</small>
                    </div>
                </router-link>
            </div>

        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li v-bind:class="[{disabled: !paginator.prev_page}]" class="page-item"><a class="page-link btn btn-primary" @click="fetchRead(paginator.prev_page)">Previous</a></li>
                <li v-bind:class="[{disabled: !paginator.next_page}]" class="page-item"><a class="page-link btn btn-primary" @click="fetchRead(paginator.next_page)">Next</a></li>
            </ul>
        </nav>
    </section>

    <section>
        <div class="mt-5 ml-lg-5 recent">
            Recent blog posts
        </div>

        <div class="row  ml-lg-5">
            <div class="card" v-bind:key="post.id" v-for="post in posts">
                <router-link :to="{name:'Userview', params:{id: post.id}}" style="color: black; text-decoration: none;">
                    <img class="card-img-top" :src='`images/${post.image}`' alt="Card image cap" style="height: 300px">
                    <div class="card-body">
                        <h5 class="card-title">{{post.title}}</h5>
                        <p class="card-text">{{post.body}}</p>
                        <div v-if="User.name == post.user_name">
                            <small class="text-muted">On {{post.created_at}} by You</small>
                        </div>
                        <div v-else>
                            <small class="text-muted">On {{post.created_at}} by {{post.user_name}}</small>
                        </div>
                    </div>
                </router-link>

            </div>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link btn btn-primary" @click="fetchPost(pagination.prev_page_url)">Previous</a></li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link btn btn-primary" @click="fetchPost(pagination.next_page_url)">Next</a></li>
            </ul>
        </nav>
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
            reads: {},
            pagination: {},
            paginator: {}

        }
    },
    created() {

        this.fetchPost();

        this.fetchRead();

    },
    methods: {
        show() {

            this.$router.push('/show')

        },
        fetchPost(page_url) {
            let vm = this;
            page_url = page_url || '/auth/posts'
            axios.get(page_url)
                .then(response => {
                    this.posts = response.data.data;
                    vm.makePagination(response.data);
                }).catch(error => console.log(error))
        },
        makePagination(data) {
            let pagination = {
                current_page: data.current_page,
                last_page: data.last_page,
                next_page_url: data.next_page_url,
                prev_page_url: data.prev_page_url
            }
            this.pagination = pagination
        },

        fetchRead(page_url) {
            let vm = this;
            page_url = page_url || '/auth/mostRead'
            axios.get(page_url)
                .then(response => {
                    this.reads = response.data.data;
                    vm.makePaginator(response.data);
                }).catch(error => console.log(error))
        },
        makePaginator(data) {
            let paginator = {
                current_page: data.current_page,
                last_page: data.last_page,
                next_page: data.next_page_url,
                prev_page: data.prev_page_url
            }
            this.paginator = paginator
        }
    }

}

/*Relationships between user and post in vue and laravel
 *Relationships in laravel
 */
</script>

<style scoped>
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
