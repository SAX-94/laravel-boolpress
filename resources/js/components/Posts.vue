<template>
    <div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-4 mb-4" v-for="post in posts" :key="post.id">
                    <ThePost :post="post"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Axios from "axios";
import ThePost from "./ThePost.vue";

export default {
    data() {
        return {
            posts: [],
        };
    },
    mounted() {
        Axios.get("/api/posts").then((resp) => {
            console.log(resp.data);
            this.posts = resp.data;
        });
    },
    components: { ThePost }
};
</script>