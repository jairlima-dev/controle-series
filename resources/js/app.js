import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';
import App from "./views/App";
import axios from "axios";
import VueAxios from "vue-axios";
import "../css/tailwind.css";

import VeeValidate from "vee-validate";

import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import {faHome, faUser, faUserPlus,faSignInAlt, faSignOutAlt, faCheck, faPen,
    faTrashAlt, faSearch, faExchangeAlt, faExternalLinkAlt, faTimes, faPlusCircle,
    faPowerOff, faCog, faUserSecret, faUndoAlt
} from '@fortawesome/free-solid-svg-icons';

library.add(faHome, faUser, faUserPlus, faSignInAlt, faSignOutAlt,faCheck, faPen,
    faTrashAlt, faSearch, faExchangeAlt, faExternalLinkAlt, faTimes, faPlusCircle,
    faPowerOff, faCog, faUserSecret, faUndoAlt);

Vue.component('font-awesome-icon', FontAwesomeIcon)



Vue.use(VueRouter);
Vue.use(VueAxios, axios);

let app = new Vue({
    el: '#app',
    router: new VueRouter(routes),
    render: app => app(App),
});
