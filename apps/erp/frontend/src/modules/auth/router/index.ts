import Login from '../Login.vue'

export default [
    {
        path: '/auth/login',
        name: 'auth.login',
        component: Login,
        meta: {
            requiresVisitor: true
        }
    },
];
