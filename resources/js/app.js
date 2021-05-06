import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';
import axios from "axios";
import VueAxios from "vue-axios";
import "../css/tailwind.css";

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

let app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});
