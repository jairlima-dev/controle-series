import Vuex from 'vuex';
import Vue from  'vue';

import api from '../api/auth';
import router from '../router'

Vue.use(Vuex, router);

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
        
        async login({ commit }, user) {
            try {
                var response = await api.login(user)
                commit('setLoggedUser', {
                    token: response.data.token,
                    user: response.data.user
                })
                router.push({ name: 'series.index'})
            } catch (error) {
                commit('setMessage', error.response.data.errors)
                setTimeout(() => commit('clearMessage'),3000)
            }
        }, 

        async logout({ commit }) {
            try {
                await api.logout()
                commit('logoutUser')
                router.push({ name: 'login' })
            } catch (error) {
                commit("setMessage", error.response.data.errors)
                setTimeout(() => commit('clearMessage'),3000)
            }
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
