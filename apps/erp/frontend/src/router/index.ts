import Vue from 'vue'
import VueRouter, {RouteConfig} from 'vue-router'
import store from "../store";
//import Home from '../views/Home.vue'
import auth from '../modules/auth/router/index';
import home from '../modules/home/router/index';
import landing from '../modules/landing/router/index';

Vue.use(VueRouter)

const routes: Array<RouteConfig> = [
    ...auth,
    ...home,
    ...landing,
    // {
    //     path: '/',
    //     name: 'Home',
    //     component: Home
    // },
    // {
    //     path: '/about',
    //     name: 'About',
    //     // route level code-splitting
    //     // this generates a separate chunk (about.[hash].js) for this route
    //     // which is lazy-loaded when the route is visited.
    //     component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
    // },
    // {
    //     path: '/todos',
    //     name: 'Todos',
    //     component: () => import('../views/TodoList.vue')
    // }
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!store.getters.isLogged) {
            next({name: 'auth.login'})
        } else {
            next();
        }
    } else if (to.matched.some(record => record.meta.requiresVisitor)) {
        if (store.getters.isLogged) {
            next({name: 'home'})
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router
