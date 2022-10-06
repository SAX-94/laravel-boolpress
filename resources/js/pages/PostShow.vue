<template>
  <div class="container">
    <div>
      <h4 v-if="post.category">Categoria: {{ post.category.name }} </h4>
      <h5 v-if="post.tags && post.tags.length > 0">Tags: 
        <div class="badge text-bg-info" v-for="tag in post.tags" :key="tag.id">{{ tag.name }}</div>
      </h5>
    </div>

    <div v-html="post.content"></div>
  </div>
</template>

<script>
import axios from 'axios';

export default {

  data() {
    return {
      post: {}
    }
  },
  methods: {
    fetchData() {
      axios.get("/api/posts/" + this.$route.params.post_slug)
        .then(resp => {
          this.post = resp.data
        })
    }
  },
  mounted() {
    this.fetchData()
  }

}
</script>