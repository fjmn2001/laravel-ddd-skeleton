export default [
    {
        path: '/companies',
        name: 'companies',
        component: () => import('../views/List.vue'),
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/companies/create',
        name: 'companies.create',
        component: () => import('../views/Create.vue'),
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/companies/edit/:id',
        name: 'companies.edit',
        component: () => import('../views/Edit.vue'),
        props: true,
        meta: {
            requiresAuth: true
        }
    },
];
