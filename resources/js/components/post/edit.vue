<template>
<div>
    <DashboardNavbar />
    <div class="text-center" style="font-weight: 700" v-if="User.disable == 1">
        <p class="checks">Your account has been disabled by the Management, contact the Administrator to Re-enable your account</p>
    </div>
    <div class="container" v-else-if="User.paid == 1 && User.activated == 1">
        <div class="card p-lg-5">
            <div class="card-body m-auto">
                <h2 class="text-center">Edit Post</h2>
                <form @submit.prevent="updatePost">
                    <div class="form-group">
                        <label for="email" class="">Post Title</label>

                        <div class="">
                            <input id="email" class="form-control" name="post" value="" autofocus v-model="post.title">
                            <span class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="text-field">Post body</label>

                        <div class="">
                            <textarea class="form-control " id="exampleFormControlTextarea1" rows="7" v-model="post.body"></textarea>

                            <span class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn  text-white" @click="updatePost">
                            <p> Update </p>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import DashboardNavbar from '../DashboardNavbar'

export default {
    components: {
        DashboardNavbar
    },

    data() {
        return {
            post: {}
        }
    },
    created() {
        this.User = JSON.parse(localStorage.getItem("User"))
        if (this.User.paid == null) {
            this.$router.push("/payment")
        } else if (this.User.paid == 1 && this.User.activated == null) {
            this.$router.push("/pending")
        } else {

            let uri = "/api/auth/posts/" + this.$route.params.id;
            this.axios.get(uri).then((response) => {
                this.post = response.data;
            });
        }
    },
    methods: {
        updatePost() {
            let uri = "/api/auth/posts/" + this.$route.params.id;
            this.axios.put(uri, this.post).then((response) => {
                this.$router.push({
                    name: 'Dashboard'
                });
            });
        }
    }
}
</script>

<style scoped>
form {
    font-size: 15px;
    font-weight: bold;
    color: #00008B;
}

button {
    margin: auto;
    text-align: center;
    width: 305px;
    height: 60px;
    margin-top: 20px;
    background-color: #00008B;
}

button:hover {
    background-color: white;
}

h2 {
    font-weight: 700;
    color: #00008B;
}

button p {
    font-size: 23px;
    font-weight: 20px;
    margin-top: 5px;
}

button p:hover {
    color: #00008B
}

h3 {
    margin: auto;
    color: #00008B
}

.input {
    height: 50px;
    font-weight: 5px;
    width: 700px;
}

.input [type="text"]:focus {
    outline: none;
    box-shadow: none !important;
}

.card {
    width: 100%;
    margin: auto;
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

@media screen and (max-width: 600px) {

    .input {
        height: 50px;
        font-weight: 5px;
        width: 250px;
    }

}
</style>
