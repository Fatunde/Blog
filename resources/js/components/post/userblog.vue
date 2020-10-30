<template>
<div>
    <DashboardNavbar />

    <section>

        <div class="mt-5 ml-5 recent">
            Most read blogs
        </div>
        <div class="row  ml-5">

            <div class="card" v-bind:key="read.id" v-for="read in reads">
                <router-link :to="{name:'Userview', params:{id: read.id}}" style="color: black; text-decoration: none;">
                    <img v-if="read.image !== 'No image'" class="card-img-top" :src='`images/${read.image}`' alt="Card image cap" style="height: 300px; border-radius: 10px 10px 0px 0px">
                    <div class="card-body">
                        <h5 class="card-title">{{read.title}}</h5>
                        <p class="card-text">{{read.body}}</p>

                        <small v-if="current_user.id == read.user_id" class="text-muted">On {{read.created_at}} by You</small>

                        <small v-else class="text-muted">On {{read.created_at}} by {{read.user_name}}</small>

                    </div>
                </router-link>
            </div>

        </div>
        <nav class="pagination mt-5" aria-label="Page navigation example">
            <ul class="pagination">
                <li v-bind:class="[{disabled: !paginator.prev_page}]" class="page-item"><a class="page-link btn btn-primary" @click="fetchRead(paginator.prev_page)">Previous</a></li>
                <li v-bind:class="[{disabled: !paginator.next_page}]" class="page-item"><a class="page-link btn btn-primary" @click="fetchRead(paginator.next_page)">Next</a></li>
            </ul>
        </nav>
    </section>

    <section>
        <div class="mt-5 ml-5 recent">
            Recent blog posts
        </div>

        <div class="row  ml-5">
            <div class="card" v-bind:key="post.id" v-for="post in posts">
                <router-link :to="{name:'Userview', params:{id: post.id}}" style="color: black; text-decoration: none;">
                    <img v-if="post.image !== 'No image'" class="card-img-top" :src='`images/${post.image}`' alt="Card image cap" style="height: 300px; border-radius: 10px 10px 0px 0px">
                    <div class="card-body">
                        <h5 class="card-title">{{post.title}}</h5>
                        <p class="card-text">{{post.body}}</p>
                        <div v-if="current_user.id == post.user_id">
                            <small class="text-muted">On {{post.created_at}} by You</small>
                        </div>
                        <div v-else>
                            <small class="text-muted">On {{post.created_at}} by {{post.user_name}}</small>
                        </div>
                    </div>
                </router-link>

            </div>
        </div>
        <nav class="pagination mt-5" aria-label="Page navigation example">
            <ul class="pagination">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link btn btn-primary" @click="fetchPost(pagination.prev_page_url)">Previous</a></li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link btn btn-primary" @click="fetchPost(pagination.next_page_url)">Next</a></li>
            </ul>
        </nav>
    </section>
    <section>
        <div class="mt-5 ml-5 recent">
            Top blog posters
        </div>

        <div class="row  ml-5 mb-5">
            <div v-bind:key="User.id" v-for="User in Users">
                <div class="card " v-if="User.role == 'user' && User.post_counts >= 1" style="width: 250px;">
                    <img v-if="User.avatar" class="card-img-top" :src='`images/${User.avatar}`' alt="Card image cap" style="height: 180px; border-radius: 50px">
                    <i v-else-if="User.avatar == null" class="fas fa-user mt-3 text-center" style="font-size: 165px; color: #686363"></i>
                    <div class="card-body">
                        <p class="card-text"> {{User.name}} {{User.lastName}}</p>
                        <small>With {{User.post_counts}} posts</small>
                    </div>
                </div>
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
            reads: {},
            pagination: {},
            paginator: {},
            Users: {},
            current_user: {}

        }
    },
    created() {
        this.fetchUser();

        this.fetchPost();

        this.fetchRead();
        this.current_user = JSON.parse(localStorage.getItem('User'))

    },
    methods: {
        show() {

            this.$router.push('/show')

        },
        fetchUser(page_url) {
            let vm = this;
            page_url = page_url || '/auth/index'
            axios.get(page_url)
                .then(response => {
                    this.Users = response.data.data;
                    console.log(this.Users)
                    vm.makePaginating(response.data);
                }).catch(error => console.log(error))
        },
        makePaginating(data) {
            let paginating = {
                current_paging: data.current_page,
                last_paging: data.last_page,
                next_paging_url: data.next_page_url,
                prev_paging_url: data.prev_page_url
            }
            this.paginating = paginating
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
