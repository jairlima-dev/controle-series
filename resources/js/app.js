import Vue from 'vue';
import App from "./views/App";

// * Vuex Store
import store from "./store";

// * Tailwind CSS
import "../css/tailwind.css";

// * VeeValidate
import { ValidationProvider, ValidationObserver } from "vee-validate";
Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);

// * FontAwesome Icons
import { FontAwesomeIcon } from "./plugins/font-awesome";
Vue.component('font-awesome-icon', FontAwesomeIcon)

// * Axios / http
import axios from "axios";
import VueAxios from "vue-axios";
Vue.use(VueAxios, axios);

// * Vue-router
import VueRouter from 'vue-router';
import router from "./router";
Vue.use(VueRouter);

new Vue({
    el: '#app',
    router,
    store,
    render: app => app(App),
});
