<template>
    <div class="post h-100">
        <img
            class="img-fluid"
            :src="'/storage/' + post.image"
            :alt="'Image of the post ' + post.title"
        />
        <div class="p-3 mb-3">
            <div class="title">{{ post.title }}</div>
            <div class="description">
                {{ post.description }}
            </div>
            <div class="row">
                <div class="col-6 author">{{ post.id }}</div>
                <div class="col-6">{{ post.user_id }}</div>
                <div class="col-12">
                    <router-link
                        :to="{
                            name: 'show',
                            params: { id: post.id },
                        }"
                        class="btn  my-3"
                        >Vai al post
                    </router-link>
                    <router-link
                        :to="{ name: 'test' }"
                        class="btn my-3"
                        >test
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ThePost",
    data() {
        return {};
    },
    props: {
        post: Object,
    },
};
</script>