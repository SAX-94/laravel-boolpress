import VueRouter from "vue-router"
import Show from "./pages/Show.vue";
import Posts from "./components/Posts.vue";

export const routes = [
    {    path : "/public" , component : Posts , name : 'posts' },
    {    path : "/public/:id" , component : Show , name : 'show' },

    
];