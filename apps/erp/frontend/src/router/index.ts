import Vue from 'vue'
import VueRouter, {RouteConfig} from 'vue-router'
//import Home from '../views/Home.vue'
import auth from '../modules/auth/router/index';
import home from '../modules/home/router/index';

Vue.use(VueRouter)

const routes: Array<RouteConfig> = [
    ...auth,
    ...home,
    // {
    //     path: '/',
    //     name: 'Home',
    //     component: Home
    // },
    {
        path: '/about',
        name: 'About',
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
    },
    {
        path: '/todos',
        name: 'Todos',
        component: () => import('../views/TodoList.vue')
    }
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

export default router
