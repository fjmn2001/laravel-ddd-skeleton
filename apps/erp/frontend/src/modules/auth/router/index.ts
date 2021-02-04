import Login from '../Login.vue'
import Recovery from '../Recovery.vue'
import PasswordReset from '../PasswordReset.vue'

export default [
    {
        path: '/auth/login',
        name: 'auth.login',
        component: Login,
        meta: {
            requiresVisitor: true
        }
    },
    {
        path: '/auth/recovery',
        name: 'auth.recovery',
        component: Recovery,
        meta: {
            requiresVisitor: true
        }
    },
    {
        path: '/auth/password_reset',
        name: 'auth.password_reset',
        component: PasswordReset,
        meta: {
            requiresVisitor: true
        }
    },
];
