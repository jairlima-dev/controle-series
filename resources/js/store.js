import Vue from  'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        token: localStorage.getItem('auth') || '',
        user: JSON.parse(localStorage.getItem('user')),
        // user: localStorage.getItem('user') || '',
    },

    mutations: {
        setToken(state,token) {
            localStorage.setItem('auth', token);
            state.token = token;
        },

        clearToken(state) {
            localStorage.removeItem('auth');
            state.token = '';
        },

        setUser(state,user) {
            localStorage.setItem('user', JSON.stringify(user));
            // localStorage.setItem('user', user);
            state.user = user;
        },

        clearUser(state) {
            localStorage.removeItem('user')
            state.user = '';
        }

    },

    }
)


// export const store = new Vuex.Store({
//     state: {
//         token: localStorage.getItem('auth') || '',
//     },
//
//     mutations: {
//         setToken(state,token) {
//             localStorage.setItem('auth', token);
//             state.token = token;
//         },
//         clearToken(state) {
//             localStorage.removeItem('auth');
//             state.token = '';
//         }
//
//     },
//
//     }
// )
