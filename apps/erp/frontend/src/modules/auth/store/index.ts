import axios from "axios";

type resetPasswordParam = {
    password: string,
    passwordConfirmation: string,
    email: string,
    token: string
}

type passwordRequestParam = {
    email: string
}

type authContext = {
    rootState: {
        ERP_URL: string,
        token: string | null
    }
}

export default function () {
    return {
        namespaced: true,
        state: {},
        mutations: {},
        actions: {
            passwordRequest(context: authContext, credentials: passwordRequestParam) {
                return new Promise((resolve, reject) => {
                    axios.post(context.rootState.ERP_URL + '/api/auth/password_request', {
                        email: credentials.email
                    })
                        .then(response => resolve(response))
                        .catch(e => reject(e));
                });
            },
            resetRassword(context: authContext, params: resetPasswordParam) {
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
        }
    };
}
