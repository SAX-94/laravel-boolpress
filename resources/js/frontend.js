import Vue from "vue"
import App from "./views/App.vue"
import router from "./router"

new Vue({
  el: "#app",
  render: (renderComponent) => renderComponent(App),
  // routere deve avere come valore un istanza di VueRouter()
  router
})