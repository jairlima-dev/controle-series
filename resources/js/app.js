import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';
import VeeValidate, { Validator } from "vee-validate";
import msgBR from 'vee-validate/dist/locale/pt_BR';

import App from "./views/App";
import axios from "axios";

import VueAxios from "vue-axios";
import "../css/tailwind.css";

import { store } from "./store";

import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import {faHome, faUser, faUserPlus,faSignInAlt, faSignOutAlt, faCheck, faPen,
    faTrashAlt, faSearch, faExchangeAlt, faExternalLinkAlt, faTimes, faPlusCircle,
    faPowerOff, faCog, faUserSecret, faUndoAlt, faLock, faForward, faBackward
} from '@fortawesome/free-solid-svg-icons';

library.add(faHome, faUser, faUserPlus, faSignInAlt, faSignOutAlt,faCheck, faPen,
    faTrashAlt, faSearch, faExchangeAlt, faExternalLinkAlt, faTimes, faPlusCircle,
    faPowerOff, faCog, faUserSecret, faUndoAlt, faLock, faForward, faBackward);

Vue.component('font-awesome-icon', FontAwesomeIcon)



Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(VeeValidate);
Validator.localize('pt_BR', msgBR);

let app = new Vue({
    el: '#app',
    router: new VueRouter(routes),
    store: store,
    render: app => app(App),
});
