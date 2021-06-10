import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';

// * VeeValidate
import { ValidationProvider, ValidationObserver } from "vee-validate";
Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);
// *** VeeValidate

import App from "./views/App";
import axios from "axios";
import VueAxios from "vue-axios";

// * CSS
import "../css/tailwind.css";


// * Vuex Store
import { store } from "./store";

// * FontAwesome Icons
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import {faHome, faUser, faUserPlus,faSignInAlt, faSignOutAlt, faCheck, faPen,
    faTrashAlt, faSearch, faExchangeAlt, faExternalLinkAlt, faTimes, faPlusCircle,
    faPowerOff, faCog, faUserSecret, faUndoAlt, faLock, faForward, faBackward,faUnlock
} from '@fortawesome/free-solid-svg-icons';

library.add(faHome, faUser, faUserPlus, faSignInAlt, faSignOutAlt,faCheck, faPen,
    faTrashAlt, faSearch, faExchangeAlt, faExternalLinkAlt, faTimes, faPlusCircle,
    faPowerOff, faCog, faUserSecret, faUndoAlt, faLock, faForward, faBackward, faUnlock);

Vue.component('font-awesome-icon', FontAwesomeIcon)
// *** FontAwesome Icons end


Vue.use(VueRouter);
Vue.use(VueAxios, axios);

let app = new Vue({
    el: '#app',
    router: new VueRouter(routes),
    store: store,
    render: app => app(App),
});
