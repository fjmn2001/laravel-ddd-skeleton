import {createRouter, createWebHistory, RouteRecordRaw} from "vue-router";
import Container from './../components/Container.vue';
import auth from '../modules/auth/router/index';
import home from "../../../vue3/src/modules/home/router";
// import landing from "../../../vue3/src/modules/landing/router";
import companies from "../../../vue3/src/modules/companies/router";

const routes: Array<RouteRecordRaw> = [
    ...auth,
    {
        path: '/',
        redirect: '/home',
        name: 'home',
        component: Container,
        children: [
            ...home,
            // ...landing,
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

export default router;
