import axios from "axios"

export default {
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
