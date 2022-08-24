
import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home';
import Register from '../pages/Register';
import Login from '../pages/Login';
import Dashboard from '../pages/Dashboard';
import AddRole from '../components/AddRole';
import AddUser from '../components/AddUser'

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'register',
        path: '/api',
        component: AddUser
    },
    {
        name: 'add-role',
        path: '/api/role/add',
        component: AddRole
    },



];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
