<template>
  <nav class="navbar navbar-expand-lg navbar-light position-sticky top-0" id="mainNav">
    <div class="container px-4 px-lg-5">

      <a class="navbar-brand" href="index.html">Laravel Boolpress</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <svg class="svg-inline--fa fa-bars" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bars"
          role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
          <path fill="currentColor"
            d="M0 96C0 78.33 14.33 64 32 64H416C433.7 64 448 78.33 448 96C448 113.7 433.7 128 416 128H32C14.33 128 0 113.7 0 96zM0 256C0 238.3 14.33 224 32 224H416C433.7 224 448 238.3 448 256C448 273.7 433.7 288 416 288H32C14.33 288 0 273.7 0 256zM416 448H32C14.33 448 0 433.7 0 416C0 398.3 14.33 384 32 384H416C433.7 384 448 398.3 448 416C448 433.7 433.7 448 416 448z">
          </path>
        </svg><!-- <i class="fas fa-bars"></i> Font Awesome fontawesome.com -->
      </button>

      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ms-auto py-4 py-lg-0">
          <li class="nav-item">
            <router-link class="nav-link px-lg-3 py-3 py-lg-4" to="/">Home</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link px-lg-3 py-3 py-lg-4" :to="{ name: 'about.index' }">About</router-link>
          </li>
          <!-- <li class="nav-item">
            <router-link class="nav-link px-lg-3 py-3 py-lg-4" to="post.html">Sample Post</router-link>
          </li> -->
          <li class="nav-item">
            <router-link class="nav-link px-lg-3 py-3 py-lg-4" :to="{ name: 'contact.index' }">Contact</router-link>
          </li>

          <li class="nav-item">
            <a v-if="user" href="/admin" class="nav-link px-lg-3 py-3 py-lg-4">{{user.name}}</a>
            <a v-else href="/login" class="nav-link px-lg-3 py-3 py-lg-4">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import Axios from 'axios';

export default {
  data() {
    return {
      user: null
    }
  },
  mounted() {
    Axios.get("/api/user")
      .then(resp => {
        this.user = resp.data
      })
  }
}
</script>

<style lang="scss">
#mainNav {
  z-index: 10;
  background-color: rgba(255, 255, 255, .7);
  backdrop-filter: blur(5px);
}
</style>