export default [
    {
        path: '/sales_settings',
        name: 'sales_settings',
        component: () => import('../views/List.vue'),
        meta: {
            requiresAuth: true
        }
    }
];
