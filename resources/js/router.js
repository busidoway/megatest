import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import Index from "./views/AdminIndex";
import Tests from "./views/AdminTests";
import Setting from "./views/AdminSetting";
import TestEdit from "./views/AdminTestEdit";

const routes = [
    {
        path: "/admin/index",
        component: Index
    },
    {
        path: "/admin/tests",
        component: Tests
    },
    {
        path: "/admin/setting",
        component: Setting
    },
    {
        path: "/admin/test-edit",
        component: TestEdit
    }
];

export default new vueRouter({
    mode: "history",
    routes
});