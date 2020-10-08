<template>
<div>
    <DashboardNavbar />
    <div>

        <div class="card-body card mt-3 rounded row-lg" style="height: 100%; font-weight: 700" v-bind:key="post.id">
            <div v-if="image">
                <img :src="image" class="card-img-top" style="height: 400px">
            </div>
            <div v-else>
                <img class="card-img-top" :src='`images/${User.avatar}`' alt="Card image cap" style="height: 400px">
            </div>
        </div>
        <div class="text-center">

            <div class="col-md-6 m-lg-auto">
                <input type="file" v-on:change="onImageChange" style="back-ground-color: #00008B">
            </div>
            <button @click="handleSubmit" class="mt-3">Upload</button>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';
import DashboardNavbar from "./DashboardNavbar";

export default {
    components: {
        DashboardNavbar
    },

    data() {

        return {
            post: {
                title: "",
                body: "",
                created_at: ""
            },
            User: {},
            image: ""

        }
    },

    mounted() {

        axios.get('/auth/me', {
                headers: {
                    Authorization: 'Bearer' + localStorage.getItem('token')
                }
            })
            .then(response => {
                this.User = response.data[0].original
                this.posts = response.data[0].original.posts

                console.log(this.User)

            })
    },
    methods: {
        onImageChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]);
        },
        createImage(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        handleSubmit(e) {
            e.preventDefault()

            axios.put('/auth/profilepicture' + this.User.id, {

                    image: this.image
                })
                .then(
                    this.$router.push({
                        name: 'Profile'
                    })

                )

                .catch(error => {
                    console.error(error);
                });

        }

    }

}
</script>

<style scoped>
.card {
    margin: auto;
    width: 400px;
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

button {
    width: 200px;
    height: 70px;
    background-color: #00008B;
    color: white;
    border-radius: 10px;
    font-weight: 700;
    font-size: 20px;

}
</style>
