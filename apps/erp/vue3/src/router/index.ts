import {createRouter, createWebHistory, RouteRecordRaw} from "vue-router";
import Home from "../views/Home.vue";
import Login from "../modules/auth/views/Login.vue";
import auth from '../modules/auth/router/index';

const routes: Array<RouteRecordRaw> = [
    ...auth,
    {
        path: "/auth/login",
        name: "auth.login",
        component: Login,
        meta: {
            requiresVisitor: true
        }
    },
    {
        path: "/",
        name: "home",
        component: Home
    },
    {
        path: "/about",
        name: "About",
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () =>
            import(/* webpackChunkName: "about" */ "../views/About.vue")
    }
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
});

export default router;
