import Login from '../views/Login.vue'
import Recovery from '../views/Recovery.vue'
import PasswordReset from '../views/PasswordReset.vue'

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
