import {createRouter, createWebHistory} from "vue-router";
import {useAuth} from "../stores/auth.js";

let routes = [
    {
        path: '/',
        name: 'app',
        component: () => import('../components/Layouts/AppLayout.vue'),
        children: [
            {
                path: '',
                name: 'home',
                component: () => import('../views/Home.vue'),
            },
            {
                path: 'genres',
                name: 'genres',
                component: () => import('../views/Genres.vue'),

            },
            {
                path: 'albums',
                name: 'albums',
                component: () => import('../views/Albums.vue'),
            },
            {
                path: 'songs',
                name: 'songs',
                component: () => import('../views/Songs.vue'),
            }
        ],

    },
    {
        path: '/admin',
        name: 'admin',
        component: () => import('../components/Layouts/MasterLayout.vue'),
        children: [
            {
                path: '/dashboard',
                name: 'admin.dashboard',
                component: () => import('../views/admin/dashboard.vue'),
            },
            {
                path: '/admin/genres',
                name: 'admin.genres',
                component: () => import('../views/admin/Genres.vue'),

            },
            {
                path: '/admin/albums',
                name: 'admin.albums',
                component: () => import('../views/admin/Albums.vue'),
            },
            {
                path: '/admin/songs',
                name: 'admin.songs',
                component: () => import('../views/admin/Songs.vue'),
            }
        ],
        meta: {
            requiresAuth: true
        },
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('../views/auth/Login.vue'),
        meta: {
            requiresGuest: true
        }
    },
    {
        path: '/register',
        name: 'register',
        component: () => import('../views/auth/Register.vue'),
        meta: {
            requiresGuest: true
        }
    }
];
const router = createRouter({
    history: createWebHistory(),
    routes: routes
});

router.beforeEach((to, from, next) => {
    const store = useAuth();
    if (to.meta.requiresAuth && !store.user.token) {
        next({name: 'login'})
    } else if (to.meta.requiresGuest && store.user.token) {
        next({name: 'admin.dashboard'})
    } else {
        next();
    }
})

export default router;
