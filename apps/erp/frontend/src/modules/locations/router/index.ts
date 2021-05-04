export default [
    {
        path: '/locations',
        name: 'locations',
        component: () => import('../view/List.vue'),
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/locations/create',
        name: 'locations.create',
        component: () => import('../view/Create.vue'),
        meta: {
            requiresAuth: true
        }
    }
];
