<template>
  <div class="container">

    <div class="row gx-4 gx-lg-5 justify-content-center">
      <div class="col-md-10 col-lg-8 col-xl-7">

        <div v-for="post in posts" :key="post.id">
          <!-- Post preview-->
          <div class="post-preview">
            <a href="post.html">
              <h2 class="post-title">{{ post.title }}</h2>
              <h3 class="post-subtitle">{{ post.content }}</h3>
            </a>
            <p class="post-meta">
              Postato da
              <a href="#!">{{ post.user.name }}</a>
              il <em>{{ new Intl.DateTimeFormat("it-IT", { dateStyle: "long", timeStyle: "short" }).format(new
                  Date(post.created_at))
              }}</em>
            </p>
          </div>

          <!-- Divider-->
          <hr class="my-4">
        </div>

        <div v-if="posts.length === 0">
          Nessun dato disponibile...</div>
      </div>
    </div>

    <div class="text-center" v-if="paginationData.current_page < paginationData.last_page">
      <button class="btn btn-primary" @click="loadMoreData">Carica post più datati</button>
    </div>

  </div>
</template>

<script>
import axios from "axios"

export default {
  data() {
    return {
      posts: [],
      paginationData: {},
      user: {}
    }
  },
  methods: {
    fetchData(page = 1) {
      axios.get("/api/posts", {
        // in axios params = query string
        params: {
          page: page,
          user_id: this.$route.params.user_id
        }
      })
        .then((resp) => {
          this.posts.push(...resp.data.data)
          this.paginationData = resp.data
        })
    },
    fetchUserData() {
      axios.get("/api/users/" + this.$route.params.user_id)
        .then((resp) => {
          this.user = resp.data

          this.$route.meta.title = "Post scritti da " + this.user.name
          this.$router.replace({ query: { temp: Date.now() } })
        })
    },
    loadMoreData() {
      const currentPage = this.paginationData.current_page

      this.fetchData(currentPage + 1)
    },

  },
  mounted() {
    this.fetchUserData();
    this.fetchData();
  }
}
</script>

<style lang="scss">
.post-preview {

  a {
    color: black;
  }

  >a {
    text-decoration: none;
  }

  .post-title {
    font-size: 2.25rem;
    margin-top: 1.875rem;
    margin-bottom: 0.625rem;
    font-weight: bolder;
  }

  .post-subtitle {
    font-weight: 300;
    margin-bottom: 0.625rem;
  }

}
</style>