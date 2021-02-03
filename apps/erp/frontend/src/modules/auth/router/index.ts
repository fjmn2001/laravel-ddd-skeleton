import Login from '../Login.vue'
import Recovery from '../Recovery.vue'

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
];
