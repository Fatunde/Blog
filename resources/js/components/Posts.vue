<template>
    <div class="container">
        <div class="card mb-2" v-for="post in posts" v-bind:key="post.id">
            <div class="card-body ">
                <h4 class="card-title">{{ post.title }}</h4>
                <p class="card-text">{{ post.body }}</p>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                posts: []
            };
        },
 
        created() {
            this.getPosts();
        },
 
        methods: {
            getPosts(api_url) {
                api_url = api_url || '/api/posts';
                fetch(api_url)
                    .then(response => response.json())
                    .then(response => {
                        this.posts = response.data;
                    })
                    .catch(err => console.log(err));
            }
        }
    };
</script>