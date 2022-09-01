<template>
    <div>
        <div class="container mt-5">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import Posts from "./components/Posts.vue";

export default {
    components: { Posts }
}

</script>