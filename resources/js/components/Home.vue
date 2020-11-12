<template>
<div class="all">
    <Navbar />
    <div class="">
        <header id="header" class="header">
            <div class="header-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="text-container">
                                <h1><span class="turquoise" style="font-weight: 700; color: #00bfd8">Welcome to Management Blog</span></h1>
                                <p class="p-large">Management blog is a platform created for open minded people who loves to see their speech and also have fun doing learning</p>
                                <router-link class="btn-solid-lg page-scroll" to="/register">Get Started</router-link>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="image-container">
                                <img class="img-fluid" src="./images/header-teamwork.svg" alt="alternative">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>

    <div class="m-3 datas">
        <div class="turquoise text-center">
            <h1 style="font-weight: 700; color: #00bfd8"><span>Blog</span></h1>
        </div>
        <div class="basic-1">
            <div class="">
                <div class="row m-lg-5">
                    <h2 class="col-lg-12 text-center" style="font-weight: 700; color: #00bfd8">Most Viewed</h2>
                    <div class="col-lg-6">
                        <div class="row  ml-4 most-read">

                            <div class="card ml-lg-4" v-bind:key="read.id" v-for="read in reads">
                                <router-link :to="{name:'Show', params:{id: read.id}}" style="color: black; text-decoration: none;">
                                    <img v-if="read.image !== 'No image'" class="card-img-top" :src='`images/${read.image}`' alt="Card image cap" style="height: 150px">

                                    <div class="card-body">
                                        <h5 class="card-title">{{read.title}}</h5>
                                        <small class="text-muted">By {{read.user_name}} on {{read.created_at}}</small>
                                    </div>
                                </router-link>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="text-container">
                            <h2 style="color: #00bfd8; font-weight: 700">These are our most viewed most posts</h2>
                            <p>This helps our users to know about their posts which is viewed more by other users</p>
                            <router-link class="btn-solid-reg popup-with-move-anim" style="" to="/index">View All</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="basic-1">
            <div class="">
                <div class="row m-lg-5">
                    <h2 class="col-lg-12 text-center" style="font-weight: 700; color: #00bfd8">Latest Posts</h2>
                    <div class="col-lg-6">
                        <div class="text-container">
                            <h2 style="color: #00bfd8; font-weight: 700">This is the latest post on the platform</h2>
                            <p>Once a post has been posted, it is seen on this part, and it helps users to views latest content by other users</p>
                            <router-link class="btn-solid-reg popup-with-move-anim" style="" to="/index">View All</router-link>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row ml-4 most-read">
                            <div class="card ml-lg-4" v-bind:key="post.id" v-for="post in posts">
                                <router-link :to="{name:'Show', params:{id: post.id}}" style="color: black; text-decoration: none;">
                                    <img v-if="post.image !== 'No image'" class="card-img-top" :src='`images/${post.image}`' alt="Card image cap" style="height: 150px">

                                    <div class="card-body">
                                        <h5 class="card-title">{{post.title}}</h5>
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
                    </div>
                </div>
            </div>
        </div>
        <div class="basic-1">
            <div class="">
                <div class="row m-lg-5">
                    <h2 class="col-lg-12 text-center" style="font-weight: 700; color: #00bfd8;">Top Posters</h2>
                    <div class="col-lg-6">
                        <div class="row  ml-4">
                            <div v-bind:key="User.id" v-for="User in Users">
                                <div class="card " v-if="User.role == 'user' && User.post_counts >= 1" style="width: 200px; height: 280px">
                                    <img v-if="User.avatar" class="card-img-top" :src='`images/${User.avatar}`' alt="Card image cap" style="height: 180px; border-radius: 50px">
                                    <i v-else-if="User.avatar == null" class="fas fa-user mt-3 text-center" style="font-size: 165px; color: #686363"></i>
                                    <div class="card-body">
                                        <p class="card-text"> {{User.name}} {{User.lastName}}</p>
                                        <small>With {{User.post_counts}} posts</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 ">
                        <div class="text-container">
                            <h2 style="color: #00bfd8; font-weight: 700">These are our users who have posted more</h2>
                            <p>We celebrate our users who took their time to post and use our platform more often, if you want to be here, join and post more</p>
                            <router-link class="btn-solid-reg popup-with-move-anim" style="" to="/index">View All</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="basic-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="text-container">
                        <h2 style="color: #00bfd8; font-weight: 700">Create memories that you can always reference to</h2>
                        <p>Use our platform to create posts that are memorable, with just a little step you can join our platform and start creating posts</p>
                        <button class="btn-solid-reg popup-with-move-anim" style="" href="#details-lightbox-1">Join</button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="image-container">
                        <img class="img-fluid" src="./images/details-1-office-worker.svg" alt="alternative">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="prices">
        <div class="container">
            <h1 class="text-center mb-5" style="font-weight: 700; color: #00bfd8"><span>Our Pricing</span></h1>
            <div class="card m-auto text-center" style="width: 350px">
                <div class="card-body">
                    <div class="card-title" style="font-weight: 700; font-size: 30px">Complete</div>
                    <div class="card-subtitle">Complete Plan to use the platform</div>
                    <hr class="cell-divide-hr">
                    <div class="price">
                        <span class="currency">#</span><span class="value">1000</span>
                        <div style="color: black; font-size: 20px" class="frequency">Full</div>
                    </div>
                    <hr class="cell-divide-hr">
                    <ul class="list-unstyled li-space-lg">
                        <li class="media">
                            <i class="fas fa-check"></i>
                            <div class="media-body">Reading Posts</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-check"></i>
                            <div class="media-body">Creating your own posts</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-check"></i>
                            <div class="media-body">Editing your existing post</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-check"></i>
                            <div class="media-body">Deleting your posts</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-times"></i>
                            <div class="media-body">Admin Permissions</div>
                        </li>
                    </ul>
                    <div class="button-wrapper">
                        <router-link class="btn-solid-reg page-scroll" to="/register">START</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="basic-1 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="image-container">
                        <img class="img-fluid" src="./images/details-2-office-team-work.svg" alt="alternative">
                    </div>
                </div>
                <div class="col-lg-6 about-text">
                    <h1 class="ml-lg-3 mb-5" style="font-weight: 700; color: #00bfd8"><span>About Us</span></h1>
                    <div class="text-container">
                        <h5 style="color: #00bfd8; font-weight: 700">Working as a team is what has been holding us and making us creative</h5>
                        <p>Our platform is used to create and share posts that are memorable to our customers. Our primary goal is content creation</p>
                        <button class="btn-solid-reg popup-with-move-anim" style="" href="#details-lightbox-1">Join</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="contact" class="form-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 contact-text">
                    <h1 class="text-center" style="color: #00bfd8; font-weight: 700">Contact Us</h1>
                    <div class="li-space-lg">
                        <p class="address">Don't hesitate to give us a call or send us a contact form message</p>
                        <p><i class="fas fa-map-marker-alt mr-1"></i>75b Olonode Street, Off Spencer St, Alagomeji-Yaba, Lagos</p>
                        <p><i class="fas fa-phone mr-1"></i><a class="turquoise">+234 806 565 467 1</a></p>
                        <p><i class="fas fa-envelope mr-1"></i><a class="turquoise">@blog-nig.com</a></p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="map-responsive">
                        <iframe src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=CREDPAL,%20Spencer%20Street,%20Lagos,%20Nigeria+(My%20Blog)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-col">
                        <h4>About Management Blog</h4>
                        <p>We're passionate about educating our users and giving them the best services we can</p>
                    </div>
                </div>
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    <div class="footer-col last">
                        <h4>Social Media</h4>
                        <span class="fa-stack">
                            <a>
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-facebook-f fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a>
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-twitter fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a>
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-google-plus-g fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a>
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-instagram fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a>
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-linkedin-in fa-stack-1x"></i>
                            </a>
                        </span>
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
            page_url = page_url || '/api/auth/index3'
            axios.get(page_url)
                .then(response => {
                    this.Users = response.data.data;
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
            page_url = page_url || '/api/auth/index4'
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
            page_url = page_url || '/api/auth/mostRead3'
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

.prices {
    background: url('./images/contact-background.jpg');
    height: 70vh
}

.datas {
    background: url('./images/contact-background.jpg')
}

.most-read {
    border-color: #00bfd8;
}

.turquoise {
    color: #00bfd8;
}

.btn-solid-reg {
    display: inline-block;
    padding: 1.1875rem 2.125rem 1.1875rem 2.125rem;
    border: 0.125rem solid #00bfd8;
    border-radius: 2rem;
    background-color: #00bfd8;
    color: #fff;
    font: 700 0.75rem/0 "Raleway", sans-serif;
    text-decoration: none;
    transition: all 0.2s;

}

.btn-solid-reg:hover {
    background-color: transparent;
    color: #00bfd8;
    text-decoration: none;
}

.btn-solid-lg {
    display: inline-block;
    padding: 1.375rem 2.625rem 1.375rem 2.625rem;
    border: 0.125rem solid #00bfd8;
    border-radius: 2rem;
    background-color: #00bfd8;
    color: #fff;
    font: 700 0.75rem/0 "Raleway", sans-serif;
    text-decoration: none;
    transition: all 0.2s;
}

.btn-solid-lg:hover {
    background-color: transparent;
    color: #00bfd8;
    text-decoration: none;
}

.header {
    background-color: #fff;
    color: #02022c
}

.header .header-content {
    padding-top: 8rem;
    padding-bottom: 4rem;
    text-align: center;
}

.header .text-container {
    margin-bottom: 4rem;
}

.header h1 {
    margin-bottom: 1.125rem;
    font-size: 2.5rem;
    line-height: 3.125rem;
}

.header .p-large {
    margin-bottom: 1.875rem;
}

.img {
    object-fit: cover;
    border-radius: 0px;
    opacity: 50%;
}

.all {
    background-color: #fff;
}

.form-2 {
    padding-top: 7rem;
    padding-bottom: 6.25rem;
    background: url('./images/contact-background.jpg') center center no-repeat;
    background-size: cover;
}

.form-2 h2 {
    margin-bottom: 1rem;
    text-align: center;
}

.form-2 .list-unstyled {
    margin-bottom: 3.75rem;
    font-size: 1rem;
    line-height: 1.5rem;
    text-align: center;
}

.form-2 .map-responsive {
    position: relative;
    overflow: hidden;
    height: 0;
    margin-bottom: 4rem;
    padding-bottom: 70%;
    border-radius: 0.25rem;
}

.form-2 .map-responsive iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
}

.footer {
    padding-top: 4.625rem;
    padding-bottom: 0.5rem;
}

.footer .footer-col {
    margin-bottom: 2.25rem;
}

.footer h4 {
    margin-bottom: 1rem;
}

.footer .list-unstyled .fas {
    color: #00bfd8;
    font-size: 0.5rem;
    line-height: 1.375rem;
}

.footer .list-unstyled .media-body {
    margin-left: 0.625rem;
}

.footer .fa-stack {
    margin-bottom: 0.75rem;
    margin-right: 0.5rem;
    font-size: 1.5rem;
}

.footer .fa-stack .fa-stack-1x {
    color: #fff;
    transition: all 0.2s ease;
}

.footer .fa-stack .fa-stack-2x {
    color: #00bfd8;
    transition: all 0.2s ease;
}

.footer .fa-stack:hover .fa-stack-1x {
    color: #fff;
}

.footer .fa-stack:hover .fa-stack-2x {
    color: #00a7bd;
}

.price {
    font-size: 35px;
    margin: auto;
    color: #00bfd8;

    font-weight: 700;
    margin-top: 30px;
}

.jumbotron {
    margin-top: -20px;
    background-image: url('./images/bg.jpeg');
    background-size: cover;
    height: 80vh;

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
    color: #00bfd8;
    font-size: 25px;
    font-weight: 700;
    margin: auto
}

h3 {
    margin: auto;
    color: #00008B;
    font-weight: 700;

}

.card-body {
    color: #00bfd8
}

.card {
    margin: 5px;
    height: 100%;
    width: 200px;
    margin-top: 30px;
    background-color: #e8f7f8;
    opacity: 80%;
    border-radius: 10px !important;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    transition: 0.3s;
    color: #00bfd8;
}

.card:hover {

    opacity: 200%;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    transform: scale(1.05) translateZ(0);
    transition-duration: 0.5s;
    transition-timing-function: linear;
    background-color: #fff;
    color: #04171a;
}

.site-footer {
    background-color: #26272b;
    padding: 45px 0 20px;
    font-size: 15px;
    line-height: 24px;
    color: #737373;
}

.site-footer hr {
    border-top-color: #bbb;
    opacity: 0.5
}

.site-footer hr.small {
    margin: 20px 0
}

.site-footer h6 {
    color: #fff;
    font-size: 16px;
    text-transform: uppercase;
    margin-top: 5px;
    letter-spacing: 2px
}

.site-footer a {
    color: #737373;
}

.site-footer a:hover {
    color: #3366cc;
    text-decoration: none;
}

.footer-links {
    padding-left: 0;
    list-style: none
}

.footer-links li {
    display: block
}

.footer-links a {
    color: #737373
}

.footer-links a:active,
.footer-links a:focus,
.footer-links a:hover {
    color: #3366cc;
    text-decoration: none;
}

.footer-links.inline li {
    display: inline-block
}

.site-footer .social-icons {
    text-align: right
}

.site-footer .social-icons a {
    width: 40px;
    height: 40px;
    line-height: 40px;
    margin-left: 6px;
    margin-right: 0;
    border-radius: 100%;
    background-color: #33353d
}

.copyright-text {
    margin: 0
}

.basic-1 {
    padding-top: 1.625rem;
    padding-bottom: 3.75rem;
}

.basic-1 .text-container {
    margin-bottom: 4rem;
}

.basic-1 h2 {
    margin-bottom: 1.375rem;
}

.basic-1 .btn-solid-reg {
    margin-top: 0.625rem;
}

@media (max-width:991px) {
    .site-footer [class^=col-] {
        margin-bottom: 30px
    }
}

@media (max-width:767px) {
    .site-footer {
        padding-bottom: 0
    }

    .site-footer .copyright-text,
    .site-footer .social-icons {
        text-align: center
    }
}

.social-icons {
    padding-left: 0;
    margin-bottom: 0;
    list-style: none
}

.social-icons li {
    display: inline-block;
    margin-bottom: 4px
}

.social-icons li.title {
    margin-right: 15px;
    text-transform: uppercase;
    color: #96a2b2;
    font-weight: 700;
    font-size: 13px
}

.social-icons a {
    background-color: #eceeef;
    color: #818a91;
    font-size: 16px;
    display: inline-block;
    line-height: 44px;
    width: 44px;
    height: 44px;
    text-align: center;
    margin-right: 8px;
    border-radius: 100%;
    -webkit-transition: all .2s linear;
    -o-transition: all .2s linear;
    transition: all .2s linear
}

.social-icons a:active,
.social-icons a:focus,
.social-icons a:hover {
    color: #fff;
    background-color: #29aafe
}

.social-icons.size-sm a {
    line-height: 34px;
    height: 34px;
    width: 34px;
    font-size: 14px
}

.social-icons a.facebook:hover {
    background-color: #3b5998
}

.social-icons a.twitter:hover {
    background-color: #00aced
}

.social-icons a.linkedin:hover {
    background-color: #007bb6
}

.social-icons a.dribbble:hover {
    background-color: #ea4c89
}

@media (max-width:767px) {
    .social-icons li.title {
        display: block;
        margin-right: 0;
        font-weight: 600
    }

    .about-text {
        text-align: center;
        margin-top: 20px;
    }

    .contact-text {
        text-align: center;
    }
}

@media (min-width: 768px) {

    .p-heading {
        width: 85%;
        margin-right: auto;
        margin-left: auto;
    }

    .header .header-content {
        padding-top: 10.5rem;
    }

    .header h1 {
        font-size: 3rem;
        line-height: 3.5rem;
    }

    .form-2 .list-unstyled li {
        display: inline-block;
        margin-right: 0.5rem;
        margin-left: 0.5rem;
    }

    .form-2 .list-unstyled .address {
        display: block;
    }
}

@media (min-width: 992px) {
    .p-heading {
        width: 65%;
    }

    .header {
        background: url('./images/header-background.jpg') center center no-repeat;
        background-size: cover;
    }

    .header .header-content {
        padding-top: 11.5rem;
        text-align: left;
    }

    .header .text-container {
        margin-top: 3rem;
        margin-bottom: 0;
    }

    .basic-1 .text-container {
        margin-top: 3.875rem;
        margin-bottom: 0;
    }

    .form-2 .map-responsive {
        margin-bottom: 0;
    }
}

@media (min-width: 1200px) {
    .header .header-content {
        padding-top: 12.5rem;
    }

    .header .text-container {
        margin-top: 5.375rem;
        margin-left: 1rem;
        margin-right: 2rem;
    }

    .header .image-container {
        margin-left: 2rem;
        margin-right: 1rem;
    }

    .basic-1 .text-container {
        margin-top: 6.125rem;
        margin-right: 4rem;
        margin-left: 1rem;
    }

    .form-2 .map-responsive {
        max-width: 31rem;
        margin-right: auto;
        margin-left: auto;
    }

    .footer .footer-col {
        width: 90%;
    }

    .footer .footer-col.middle {
        margin-right: auto;
        margin-left: auto;
    }

    .footer .footer-col.last {
        margin-right: 0;
        margin-left: auto;
    }
}
</style>
