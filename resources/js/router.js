import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import Index from "./views/AdminIndex";
import TestBoxes from "./views/AdminTestBoxes";
import Setting from "./views/AdminSetting";
import TestBoxEdit from "./views/AdminTestBoxEdit";
import Tests from "./views/AdminTests";

const routes = [
    {
        path: "/admin/index",
        component: Index
    },
    {
        path: "/admin/tests",
        component: TestBoxes
    },
    {
        path: "/admin/setting",
        component: Setting
    },
    {
        path: "/admin/test-edit",
        component: TestBoxEdit
    },
    {
        path: "/admin/test_boxes/:id",
        component: Tests
    }
];

export default new vueRouter({
    mode: "history",
    routes
});