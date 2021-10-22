import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import Index from "./views/AdminIndex";
import Tests from "./views/AdminTests";
import Setting from "./views/AdminSetting";

const routes = [
    {
        path: "/index",
        component: Index
    },
    {
        path: "/tests",
        component: Tests
    },
    {
        path: "/setting",
        component: Setting
    }
];

export default new vueRouter({
    mode: "history",
    routes
});