export default [
    {
        path: '/inventory_settings',
        name: 'inventory_settings',
        component: () => import('../views/List.vue'),
        meta: {
            requiresAuth: true
        }
    }
];
