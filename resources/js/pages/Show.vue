<template>
    <div>
        <img :src="'/storage/' + post.image" alt="" class="img-fluid" />
        <h1>{{ post.title }}</h1>
        <p class="text-medium">{{ post.description }}</p>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            post: {},
        };
    },

    mounted() {
        console.log(this.$route);
        axios.get("/api/posts/" + this.$route.params.id).then((resp) => {
            const data = resp.data;
            this.post = data;
        });
    },
};
</script>

<style lang="scss" scoped>