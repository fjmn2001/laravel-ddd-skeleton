export default [
    {
        path: '/clients',
        name: 'clients',
        component: () => import('../views/List.vue'),
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/clients/create',
        name: 'clients.create',
        component: () => import('../views/Create.vue'),
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/clients/edit/:id',
        name: 'clients.edit',
        component: () => import('../views/Edit.vue'),
        props: true,
        meta: {
            requiresAuth: true
        }
    },
];
