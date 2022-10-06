<template>
  <div class="container">

    <div class="row gx-4 gx-lg-5 justify-content-center">
      <div class="col-md-2">
        <h3>Filtri</h3>
        <div>
          Testo libero
        </div>
        <div>
          Categorie:
        </div>
        <div>
          Tags:
        </div>


      </div>

      <div class="col-md-10 col-lg-8 col-xl-7">

        <div v-for="post in posts" :key="post.id">
          <!-- Post preview-->
          <div class="post-preview">
            {{post.slug}}
            <router-link :to="{ name: 'posts.show', params: { post_slug: post.slug } }">
              <h2 class="post-title">{{ post.title }}</h2>
              <h3 class="post-subtitle">{{ post.content }}</h3>
            </router-link>
            <p class="post-meta">
              Postato da
              <router-link :to="{ name: 'user.posts', params: { 'user_id': post.user.id } }">
                {{ post.user.name }}
              </router-link>
              il <em>{{ new Intl.DateTimeFormat("it-IT", { dateStyle: "long", timeStyle: "short" }).format(new
                  Date(post.created_at))
              }}</em>
            </p>
          </div>

          <!-- Divider-->
          <hr class="my-4">
        </div>
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
      paginationData: {}
    }
  },
  methods: {
    fetchData(page = 1) {
      axios.get("/api/posts?page=" + page)
        .then((resp) => {
          this.posts.push(...resp.data.data)
          this.paginationData = resp.data
        })
    },
    loadMoreData() {
      const currentPage = this.paginationData.current_page

      this.fetchData(currentPage + 1)
    },
    /**
     * 
     * @param {string} text 
     * @param {number} limit 
     */
    truncateText(text, limit = 100) {
      return text.substring(0, limit) + "..."
    }
  },
  mounted() {
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