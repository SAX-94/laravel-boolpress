<template>
  <div>
    <!-- navbar -->
    <TheNavbar></TheNavbar>

    <main class="pb-5">
      <PageHeader></PageHeader>
      
      <!-- contenuto di ogni pagina -->
      <!-- simile allo @yield di balde -->
      <router-view></router-view>

      <!-- <Home v-if="page === 'home'"></Home> -->
      <!-- <About v-else-if="page === 'about'"></About> -->
      <!-- <Contact v-else-if="page === 'contact'"></Contact> -->
    </main>

    <!-- footer -->
    <TheFooter></TheFooter>
  </div>
</template>

<script>
import TheNavbar from '../components/TheNavbar.vue';
import TheFooter from '../components/TheFooter.vue';
import Home from '../pages/Home.vue';
import About from '../pages/About.vue';
import Contact from '../pages/Contact.vue';
import PageHeader from '../components/PageHeader.vue';

export default {
  components: { TheNavbar, TheFooter, Home, About, Contact, PageHeader },
  data() {
    return {
      page: "home"
    }
  }
}
</script>