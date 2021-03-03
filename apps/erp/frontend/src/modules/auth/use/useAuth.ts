import {ref, Ref} from "vue";
import axios from "axios";
import {useCore} from "@/modules/shared/use/useCore";

type retrieveTokenParam = {
    username: string
    password: string
}

type passwordRequestParam = {
    email: string
}

const token: Ref<string | null> = ref(localStorage.getItem('access_token') || null)

export function useAuth() {
    const {ERP_URL} = useCore();

    function isLogged() {
        return token.value !== null;
    }

    function retrieveToken(credentials: retrieveTokenParam) {
        return new Promise((resolve, reject) => {
            axios.post(ERP_URL + '/api/auth/login', {
                username: credentials.username,
                password: credentials.password
            }).then(response => {
                const myToken = response.data.access_token;

                localStorage.setItem('access_token', myToken);
                token.value = myToken
                resolve(response);
            }).catch(e => reject(e));
        });
    }

    function destroyToken() {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token.value;

        return new Promise((resolve, reject) => {
            axios.post(ERP_URL + '/api/auth/logout').then(response => {

                localStorage.removeItem('access_token');
                token.value = null;
                resolve(response);
            }).catch(e => reject(e));
        });
    }

    function validationToken() {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token.value;
        axios.get(ERP_URL + '/api/user').catch(() => {
            localStorage.removeItem('access_token');
            token.value = null;
        });
    }

    function passwordRequest(credentials: passwordRequestParam) {
        return new Promise((resolve, reject) => {
            axios.post(ERP_URL + '/api/auth/password_request', {
                email: credentials.email
            })
                .then(response => resolve(response))
                .catch(e => reject(e));
        });
    }

    function resetPassword(params: { passwordConfirmation: string; password: string; email: string | null; token: string | null }) {
        return new Promise((resolve, reject) => {
            axios.post(ERP_URL + '/api/auth/reset_password', {
                password: params.password,
                passwordConfirmation: params.passwordConfirmation,
                email: params.email,
                token: params.token,
            })
                .then(response => resolve(response))
                .catch(e => reject(e));
        });
    }

    return {
        token,
        isLogged,
        retrieveToken,
        destroyToken,
        validationToken,
        passwordRequest,
        resetPassword
    }
}
