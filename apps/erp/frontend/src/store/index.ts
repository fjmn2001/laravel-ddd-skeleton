import Vue from 'vue'
import Vuex from 'vuex'
import axios from "axios"
import companies from './../modules/companies/Infrastructure/store'

Vue.use(Vuex)

export default new Vuex.Store({
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
                },
                resetRassword(context, params) {
                    return new Promise((resolve, reject) => {
                        axios.post(context.rootState.ERP_URL + '/api/auth/reset_password', {
                            password: params.password,
                            passwordConfirmation: params.passwordConfirmation,
                            email: params.email,
                            token: params.token,
                        })
                            .then(response => resolve(response))
                            .catch(e => reject(e));
                    });
                }
            },
        },
        companies: companies()
    }
})
