import Vue from 'vue'
import Vuex from 'vuex'
import axios from "axios"
import * as types from './mutation-types'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        ERP_URL: process.env.VUE_APP_ERP_URL,
        token: localStorage.getItem('access_token') || null
    },

    getters: {
        isLogged(state) {
            return state.token !== null;
        }
    },

    mutations: {
        [types.RETRIEVE_TOKEN](state, token) {
            state.token = token;
        },

        [types.DESTROY_TOKEN](state) {
            state.token = null;
        },
    },

    actions: {
        register(context, register) {
            return new Promise((resolve, reject) => {
                axios.post('/api/register', {
                    name: register.name,
                    email: register.email,
                    password: register.password
                }).then(response => {
                    resolve(response);
                }).catch(e => reject(e));
            });
        },

        retrieveToken(context, credentials) {
            return new Promise((resolve, reject) => {
                axios.post(context.state.ERP_URL + '/api/auth/login', {
                    username: credentials.username,
                    password: credentials.password
                }).then(response => {
                    const token = response.data.access_token;

                    localStorage.setItem('access_token', token);
                    context.commit(types.RETRIEVE_TOKEN, token);
                    resolve(response);
                }).catch(e => reject(e));
            });
        },

        destroyToken(context) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token;

            return new Promise((resolve, reject) => {
                axios.post(context.state.ERP_URL + '/api/auth/logout').then(response => {

                    localStorage.removeItem('access_token');
                    context.commit(types.DESTROY_TOKEN, null);
                    resolve(response);
                }).catch(e => reject(e));
            });
        },
    },
    modules: {
        auth: {
            namespaced: true,
            actions: {
                passwordRequest(context, credentials) {
                    return new Promise((resolve, reject) => {
                        axios.post(context.rootState.ERP_URL + '/api/auth/password_request', {
                            email: credentials.email
                        })
                            .then(response => resolve(response))
                            .catch(e => reject(e));
                    });
                }
            },
        }
    }
})
