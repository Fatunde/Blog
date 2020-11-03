<template>
<div class="all">
    <Navbar />
    <div class="">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" style="margin-top: -10px" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./images/pricing1.jpg" class="d-block w-100 img" alt="..." style="height: 60vh; background-size: contain;">
                    <div class="carousel-caption cappy mb-lg-5">

                        <h1 class="display-4 mb-lg-5" style="color: #02022c; font-weight: 900;">Welcome</h1>
                        <p class="lead">This is a Platform where you can create to have fun</p>

                        <p class="lead mb-lg-5">Creating of post is made easy with just little price</p>

                        <router-link class="button btn mb-lg-5" to="/about">
                            <div class="mt-3">Click here to get started</div>
                        </router-link>

                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./images/pricing2.jpg" class="d-block w-100 img" alt="..." style="height: 60vh">
                    <div class="carousel-caption cappy mb-lg-5">
                        <div>
                            <h1 class="display-4 mb-lg-5" style="color: #02022c; font-weight: 900;">Welcome</h1>
                            <p class="lead">This is a Platform where you can create to have fun</p>

                            <p class="lead mb-lg-5">Creating of post is made easy with just little price</p>

                            <router-link class="button btn mb-lg-5" to="/about">
                                <div class="mt-3">Click here to get started</div>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./images/pricing3.jpg" class="d-block w-100 img" alt="..." style="height: 60vh">
                    <div class="carousel-caption cappy mb-lg-5">
                        <div>
                            <h1 class="display-4 mb-lg-5" style="color: #02022c; font-weight: 900;">Welcome</h1>
                            <p class="lead">This is a Platform where you can create to have fun</p>

                            <p class="lead mb-lg-5">Creating of post is made easy with just little price</p>

                            <router-link class="button btn mb-lg-5" to="/about">
                                <div class="mt-3">Click here to get started</div>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./images/bg.jpeg" class="d-block w-100 img" alt="..." style="height: 60vh">
                    <div class="carousel-caption mb-lg-5 cappy">
                        <div>
                            <h1 class="display-4 mb-lg-5" style="color: #02022c; font-weight: 900;">Welcome</h1>
                            <p class="lead">This is a Platform where you can create to have fun</p>

                            <p class="lead mb-lg-5">Creating of post is made easy with just little price</p>

                            <router-link class="button btn mb-lg-5" to="/about">
                                <div class="mt-3">Click here to get started</div>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div>
            <section class="m-4">

                <div class="mt-5 ml-lg-5 recent">
                    Most read blogs
                </div>
                <div class="row  ml-4">

                    <div class="card ml-lg-4" v-bind:key="read.id" v-for="read in reads">
                        <router-link :to="{name:'Show', params:{id: read.id}}" style="color: black; text-decoration: none;">
                            <img v-if="read.image !== 'No image'" class="card-img-top" :src='`images/${read.image}`' alt="Card image cap" style="height: 300px">

                            <div class="card-body">
                                <h5 class="card-title">{{read.title}}</h5>
                                <p class="card-text">{{read.body}}</p>
                                <small class="text-muted">By {{read.user_name}} on {{read.created_at}}</small>
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

            <section class="m-4">
                <div class="mt-5 ml-lg-5 recent">
                    Recent blog posts
                </div>

                <div class="row ml-4">
                    <div class="card ml-lg-4" v-bind:key="post.id" v-for="post in posts">
                        <router-link :to="{name:'Show', params:{id: post.id}}" style="color: black; text-decoration: none;">
                            <img v-if="post.image !== 'No image'" class="card-img-top" :src='`images/${post.image}`' alt="Card image cap" style="height: 300px">

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
                <nav class="pagination mt-5" aria-label="Page navigation example">
                    <ul class="pagination">
                        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link btn btn-primary" @click="fetchPost(pagination.prev_page_url)">Previous</a></li>
                        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link btn btn-primary" @click="fetchPost(pagination.next_page_url)">Next</a></li>
                    </ul>
                </nav>
            </section>
            <section class="m-4">
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
                <!----  <nav class="pagination mt-5" aria-label="Page navigation example">
                    <ul class="pagination">
                        <li v-bind:class="[{disabled: !paginator.prev_paging_url}]" class="page-item"><a class="page-link btn btn-primary" @click="fetchUser(paginator.prev_paging_url)">Previous</a></li>
                        <li v-bind:class="[{disabled: !paginator.next_paging_url}]" class="page-item"><a class="page-link btn btn-primary" @click="fetchUser(paginator.next_paging_url)">Next</a></li>
                    </ul>
                </nav>-->

            </section><br />
        </div>
        <div class="row mt-5">
            <div class="col-sm m-5">
                <h2 style="color: #02022c; font-weight: 700">About Us</h2>
                <div style="font-size: 20px; color: #686363; font-weight: 100">We love peolple to show love between each other which is the primary goal of this platform and also posting an sharing ideas helps our community grow and makes us understand each other more.
                    We also made it easy for our customers to pour out there mind to the world because everyone matters with each and every of their respective opinion. We also help in content management and make sure our clients don't violate any of our guide lines, we teach, educate, and entertain. We are MANAGEMENT Blog. <br />
                    We love peolple to show love between each other which is the primary goal of this platform and also posting an sharing ideas helps our community grow and makes us understand each other more.
                    We also made it easy for our customers to pour out there mind to the world because everyone matters with each and every of their respective opinion. We also help in content management and make sure our clients don't violate any of our guide lines, we teach, educate, and entertain. We are MANAGEMENT Blog.</div>
                <router-link class="button-primary btn mt-3" to="/register">
                    <div class="mt-4"> Click here to Join <i class="fas fa-arrow-right"></i> </div>
                </router-link>
            </div>
            <div class="col-sm pricing">
                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./images/pricing1.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h1 style="font-weight: 700">Learn more and gain more</h1>

                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="./images/pricing2.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h1 style="font-weight: 700">Sign up with us and get started</h1>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="./images/pricing3.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">

                                <h1 style="font-weight: 700">Get yourself involved in fun</h1>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="./images/pricing4.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">

                                <h1 style="font-weight: 700">Learn by having fun</h1>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="footer text-center">
            <div>
                <br />
                <div class="footer-head mt-5">
                    Contact Us
                </div>

                <div class="row text-white mt-5 ">
                    <div class="col-sm"><i class="fab fa-facebook mr-2" style="font-size: 25px"></i>
                        @Blog.facebook.com
                    </div>
                    <div class="col-sm"><i class="fab fa-instagram mr-2" style="font-size: 25px"></i>
                        @Blog
                    </div>
                    <div class="col-sm"><i class="fas fa-envelope mr-2" style="font-size: 25px"></i>
                        Blog@blog.com
                    </div>
                    <div class="col-sm"><i class="fab fa-twitter-square mr-2" style="font-size: 25px"></i>
                        @Blog
                    </div>
                    <div class="col-sm"><i class="fas fa-phone-square-alt mr-2" style="font-size: 25px"></i>
                        08011122233
                    </div>
                    <div class="col-sm"><i class="fas fa-address-book mr-2" aria-hidden="true" style="font-size: 25px"></i>
                        No 3, Blog Road, Lagos
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';
import Navbar from './Navbar';

export default {

    components: {
        Navbar
    },

    data() {

        return {
            User: {
                name: "",
                lastNmae: "",
                avatar: ""
            },
            Users: {},

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

        this.fetchUser();

    },
    methods: {
        show() {

            this.$router.push('/show')

        },
        fetchUser(page_url) {
            let vm = this;
            page_url = page_url || '/api/auth/index'
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
            page_url = page_url || '/api/auth/posts'
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
            page_url = page_url || '/api/auth/mostRead'
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
@media screen and (max-width: 600px) {}

.img {
    object-fit: cover;
    border-radius: 0px;
    opacity: 50%;
}

.all {
    background-color: rgb(248, 244, 245);
}

.footer-head {
    color: #ffffff;
    font-weight: 700;
    font-size: 30px;
    margin-top: 40px
}

.footer {
    margin-top: -19px;
    font-weight: 500;
    background-color: #02022c;
    height: 50vh;
    justify-content: center;
}

.price {
    font-size: 35px;
    margin: auto;
    color: #02022c;
    font-weight: 700;
    margin-top: 30px;
}

.jumbotron {
    margin-top: -20px;
    background-image: url('./images/bg.jpeg');
    background-size: cover;
    height: 70vh;

}

.pricing img {
    background-size: contain;
    background-repeat: no-repeat;
    height: 70vh;
    border-radius: 0px;
}

.button {
    text-decoration: none;
    background-color: #00008B;
    height: 70px;
    width: 250px;
    opacity: 80%;
    border-radius: 50px !important;
    color: white;
    text-align: center;
    font-weight: 700;

}

.button-primary {
    text-decoration: none;
    background-color: #00008B;
    height: 90px;
    width: 350px;
    opacity: 80%;
    border-radius: 50px !important;
    color: white;
    text-align: center;
    font-weight: 700;
}

p {
    color: #02022c;
    font-weight: 900;
}

.button-primary:hover {
    background-color: white;
    opacity: 200%;
    transform: scale(1.10) translateZ(0);
    transition-duration: 0.5s;
    transition-timing-function: linear;
    color: #00008B !important;
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

.pagination {
    margin: auto;
}

img {
    border-radius: 10px 10px 0px 0px;
}

.recent {
    color: #02022c;
    font-size: 25px;
    font-weight: 700;
    margin-left: 20px;
}

h3 {
    margin: auto;
    color: #00008B;
    font-weight: 700;

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
