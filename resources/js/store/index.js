import Vuex from 'vuex';
import Vue from  'vue';

import api from '../api/auth';

Vue.use(Vuex);

const store = new Vuex.Store({

    state: {
        token: localStorage.getItem('token') || '',
        user: JSON.parse(localStorage.getItem('user')) || {},
        message: ''
    },

    mutations: {
        setLoggedUser(state, { token, user }) {
            localStorage.setItem('token', token)
            localStorage.setItem('user', JSON.stringify(user))
            state.token = token
            state.user = user
        },

        logoutUser(state) {
            localStorage.removeItem('token')
            localStorage.removeItem('user')
            state.token = ''
            state.user = {}
        },

        setMessage(state, message) {
            state.message = message
        },

        clearMessage(state) {
            state.message = ''
        }
    },

    actions: {

        login({ commit }, user) {
            return api.login(user)
                .then(response => {
                    commit('setLoggedUser', {
                        token: response.data.token,
                        user: response.data.user
                    })
                    return Promise.resolve(response)
                })
                .catch(error => {
                    commit('setMessage', error.response.data.errors)
                    setTimeout(() => commit('clearMessage'),3000)
                    return Promise.reject(error)
                })
        },

        logout({ commit }) {
            return api.logout()
                .then(response => {
                    commit('logoutUser')
                    return Promise.resolve(response.data)
                })
                .catch(error => {
                    commit("setMessage", error.response.data.errors)
                    setTimeout(() => commit('clearMessage'),3000)
                    return Promise.reject(error)
                })
        }
    },

    getters: {
        loggedUser: state => state.user,
        currentToken: state => state.token,
        getMessage: state => state.message,
    },

    modules: {}

})

export default store
