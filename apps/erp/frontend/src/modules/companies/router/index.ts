export default [
    {
        path: '/companies',
        name: 'companies',
        component: () => import('../List.vue'),
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/companies/create',
        name: 'companies.create',
        component: () => import('../Create.vue'),
        meta: {
            requiresAuth: true
        }
    },
];
