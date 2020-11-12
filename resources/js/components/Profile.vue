<template>
<div class="all">
    <DashboardNavbar />

    <div class="card mt-3  card-body rounded " v-bind:key="User.id">

        <router-link v-if="User.avatar" to="/profilepicture"> <img class="card-img-top" :src='`images/${User.avatar}`' alt="Card image cap" style="height: 300px; border-radius:200px;"></router-link>
        <div v-else-if="User.avatar == null" style="height: 300px; border-radius:200px;" class="text-center border">
            <div v-if="image" style="margin: auto;">
                <input type="file" v-on:change="onImageChange" style="back-ground-color: #00bfd8" hidden id="upload">
                <label for="upload"> <img :src="image" class="card-img-top" style="height: 300px; border-radius:200px; width: 300px"></label>
                <button @click="handleSubmit" class="file text-center" style="margin-top: -30px">Upload</button>
            </div>
            <div v-else class="card-img-top">
                <input type="file" v-on:change="onImageChange" style="back-ground-color: #00bfd8" hidden id="upload">
                <label for="upload"> <i class="fas fa-user mt-3" style="font-size: 200px; color: #686363"></i></label>
                <div style="font-weight: 700">Add a Profile Picture</div>
            </div>
        </div>
        <div class="down">
            <h5 class="mt-5" style="font-weight: 700">{{User.name}} {{User.lastName}}</h5>
            <h5 class="mt-5" style="font-weight: 700">{{User.email}}</h5>
            <h5 class="mt-5" style="font-weight: 700">No of Posts: {{User.post_counts}}</h5>
            <div class="text-center mt-2">
                <router-link to="/updateprofile" class="btn button" style="font-weight: 700" v-if="User.disable == 0 || User.disable == null">
                    <p class="mt-2">Edit Your Profile</p>
                </router-link>
            </div>
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

    mounted() {
        axios.get('/api/auth/me', {
                headers: {
                    Authorization: 'Bearer' + localStorage.getItem('token')
                }
            })
            .then(response => {
                this.User = response.data[0]
                this.posts = response.data[0].original.posts
                this.id = this.User.id

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

            axios.put('/api/auth/profilepicture' + this.User.id, {

                    image: this.image
                })
                .then(
                    this.$router.push('/profileupdatesuccess')

                )

                .catch(error => {
                    //  console.error(error);
                });

        }
    },
    data() {

        return {
            User: {
                name: "",
                email: "",
                lastName: ""

            },
            posts: [],
            image: ""
        }
    },

}
</script>

<style scoped>
.all {
    background: url('./images/contact-background.jpg');
    height: 100%;
}

.down {
    margin-top: 20px;
}

.file {
    background-color: #00bfd8;
    color: white;
    padding: 0.5rem;
    border-radius: 0.3rem;
    cursor: pointer;
    margin-top: 1rem;
    width: 250px;
    margin-left: 1rem;

}

.card {
    color: #00bfd8;
    margin: auto;
    width: 350px;
    height: 100%;
    margin-top: 50px;
    background-color: #e8f7f8;
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

.button {
    width: 190px;
    height: 50px;
    background-color: #00bfd8;
    border: none !important;
    outline: none !important;
    border-radius: 5px;
    color: white;

}

.button:hover {
    color: #00bfd8;
    background-color: white;
}
</style>
