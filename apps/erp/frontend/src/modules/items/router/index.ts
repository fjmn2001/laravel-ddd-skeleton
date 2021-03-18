export default [
    {
        path: '/items',
        name: 'items',
        component: () => import('../views/List.vue'),
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/items/create',
        name: 'items.create',
        component: () => import('../views/Create.vue'),
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/items/edit/:id',
        name: 'items.edit',
        component: () => import('../views/Edit.vue'),
        props: true,
        meta: {
            requiresAuth: true
        }
    },
];
