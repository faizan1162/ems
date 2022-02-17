import { createRouter, createWebHistory } from "vue-router";
import store from '../store'
import AdminLogin from '../views/AdminLogin.vue';
import AdminDashboard from '../views/AdminDashboard';
import AddEvent from '@/views/event/AddEvent';
import EventList from '@/views/event/EventList';
import EventDetails from '@/views/event/EventDetails';
import TicketList from '@/views/ticket/TicketList';
import TicketBook from '@/views/ticket/TicketBook';
import SalesReport from '@/views/sales/SalesReport';
import AddUser from '@/views/user/AddUser';
const routes = [{
        path: "/",
        component: AdminLogin,
    },
    {
        path: "/login",
        name: "AdminLogin",
        component: AdminLogin,
    },
    {
        path: "/dashboard",
        name: "AdminDashboard",
        component: AdminDashboard,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/user/add",
        name: "AddUser",
        component: AddUser,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/event/add",
        name: "AddEvent",
        component: AddEvent,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/events",
        name: "EventList",
        component: EventList,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/event/:slug",
        name: "EventDetails",
        component: EventDetails,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/event/ticket/book",
        name: "TicketBook",
        component: TicketBook,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/tickets",
        name: "TicketList",
        component: TicketList,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/sales-report",
        name: "SalesReport",
        component: SalesReport,
        meta: {
            requiresAuth: true,
        },
    },
];
//event-mangement-admin

const router = createRouter({
    linkExactActiveClass: 'active',
    history: createWebHistory(process.env.BASE_URL),
    routes
})
router.beforeEach((to, from, next) => {
    // console.log(`Navigating to: ${to.name}`);
    let isAuthtenticate = store.getters['account/isLoggedIn'];
    //console.log(isAuthtenticate);
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!isAuthtenticate) {
            next({ name: 'AdminLogin' })
        } else {
            next() // go to wherever I'm going
        }
    } else {
        next() // does not require auth, make sure to always call next()!
    }
})
export default router