import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import AdminIndex from "./views/AdminIndex";
import AdminTestBoxes from "./views/AdminTestBoxes";
import AdminSetting from "./views/AdminSetting";
import AdminTestBoxEdit from "./views/AdminTestBoxEdit";
import AdminTests from "./views/AdminTests";
import AdminTestEdit from "./views/AdminTestEdit";
import Tests from "./views/Tests.vue";

const routes = [
    {
        path: "/admin/index",
        component: AdminIndex
    },
    {
        path: "/admin/tests",
        component: AdminTestBoxes
    },
    {
        path: "/admin/tests/page/:page",
        component: AdminTestBoxes
    },
    {
        path: "/admin/setting",
        component: AdminSetting
    },
    {
        path: "/admin/test",
        component: AdminTestBoxEdit
    },
    {
        path: "/admin/test/:id",
        component: AdminTestBoxEdit
    },
    {
        path: "/admin/tests/:id",
        component: AdminTests
    },
    {
        path: "/admin/tests/:id/page/:page",
        component: AdminTests
    },
    {
        path: "/admin/tests/:id/q",
        component: AdminTestEdit
    },
    {
        path: "/admin/tests/:id/q/:qid",
        component: AdminTestEdit
    },
    {
        path: "/test/:id",
        component: Tests
    }
];

export default new vueRouter({
    mode: "history",
    routes
});