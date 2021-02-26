import {createRouter, createWebHistory, RouteRecordRaw} from "vue-router";
//import {useStore} from 'vuex'
import Container from './../components/Container.vue';
import auth from '../modules/auth/router/index';
import home from "../modules/home/router";
import landing from "../modules/landing/router";
import companies from "../modules/companies/router";

const routes: Array<RouteRecordRaw> = [
    ...auth,
    {
        path: '/',
        redirect: '/home',
        name: 'home',
        component: Container,
        children: [
            ...home,
            ...landing,
            ...companies
        ]
    }
    // {
    //     path: "/about",
    //     name: "About",
    //     // route level code-splitting
    //     // this generates a separate chunk (about.[hash].js) for this route
    //     // which is lazy-loaded when the route is visited.
    //     component: () =>
    //         import(/* webpackChunkName: "about" */ "../views/About.vue")
    // }
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
});
// const store = useStore();
//
// router.beforeEach((to, from, next) => {
//     if (to.matched.some(record => record.meta.requiresAuth)) {
//         if (!store.getters.isLogged) {
//             next({name: 'auth.login'})
//         } else {
//             next();
//         }
//     } else if (to.matched.some(record => record.meta.requiresVisitor)) {
//         if (store.getters.isLogged) {
//             next({name: 'home'})
//         } else {
//             next();
//         }
//     } else {
//         next();
//     }
// });

export default router;
