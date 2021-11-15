import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import Index from "./views/AdminIndex";
import TestBoxes from "./views/AdminTestBoxes";
import Setting from "./views/AdminSetting";
import TestBoxEdit from "./views/AdminTestBoxEdit";
import Tests from "./views/AdminTests";
import TestEdit from "./views/AdminTestEdit";

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
        path: "/admin/tests/edit",
        component: TestBoxEdit
    },
    {
        path: "/admin/tests/:id",
        component: Tests
    },
    {
        path: "/admin/tests/:id/question",
        component: TestEdit
    }
];

export default new vueRouter({
    mode: "history",
    routes
});