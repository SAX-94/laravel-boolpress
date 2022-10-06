import Vue from "vue"
import VueRouter from "vue-router"

import Home from "./pages/Home.vue"
import About from "./pages/About.vue"
import Contact from "./pages/Contact.vue"
import UserPosts from "./pages/UserPosts.vue"
import PostShow from "./pages/PostShow.vue"
import PageNotFound from "./pages/PageNotFound.vue"

// deve comunicare a vue che vogliamo usare questa libreria
Vue.use(VueRouter)

/**
 * dobbiamo creare un array con le rotte
 * @type {import("vue-router").RouteConfig[]}
 */
const routes = [
  /*
    path = URI da scrivere nella barra dell'indirizzo
    component = il componente da mostrare quando la pagina viene visualizzata
    name = nome da assegnare a questa rotta
  */
  {
    path: "/", component: Home, name: "home.index",
    meta: {
      title: "Clean Blog",
      subtitle: "A Blog made by class #65",
      bgImage: "home-bg.jpeg"
    }
  },
   {
    path: "/posts/:post_slug", component: PostShow, name: "posts.show",
    meta: {
      title: "Dettagli post",
      subtitle: "Dettagli del post #",
    }
  },
  {
    path: "/:user_id/posts", component: UserPosts, name: "user.posts",
    meta: {
      title: "Post utente",
      subtitle: "Lista dei posti scritti da questo utente",
      bgImage: "home-bg.jpeg"
    }
  },
  {
    path: "/chi-siamo", component: About, name: "about.index",
    meta: {
      title: "Su di noi",
      subtitle: "nemmeno una nuvola",
      bgImage: "about-bg.jpeg"
    }
  },
  {
    path: "/contatti", component: Contact, name: "contact.index",
    meta: {
      title: "Contattaci",
      subtitle: "Scrivici un messaggio per dirci che hai pensato",
      bgImage: "contact-bg.jpeg"
    }
  },
  { path: "*", component: PageNotFound },
]

// dobbiamo esportare un istanza di VueRouter() con le eventuali configurazioni
const router = new VueRouter({
  // deve contenere un array di rotte
  routes,
  mode: "history"
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title ?? "Laravel Boolpress"

  next()
})


export default router
