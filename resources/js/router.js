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
import AdminStudents from "./views/AdminStudents";
import AdminStudentEdit from "./views/AdminStudentEdit";
import AdminMembers from "./views/AdminMembers";
import AdminMemberEdit from "./views/AdminMemberEdit";
import PrintResult from "./views/PrintResult";

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
        path: "/admin/students",
        component: AdminStudents
    },
    {
        path: "/admin/student",
        component: AdminStudentEdit
    },
    {
        path: "/admin/student/:id",
        component: AdminStudentEdit
    },
    {
        path: "/admin/students/page/:page",
        component: AdminStudents
    },
    {
        path: "/test/:id",
        component: Tests
    },
    {
        path: "/admin/members",
        component: AdminMembers
    },
    {
        path: "/admin/member",
        component: AdminMemberEdit
    },
    {
        path: "/admin/member/:id",
        component: AdminMemberEdit
    },
    {
        path: "/admin/members/page/:page",
        component: AdminMembers
    },
    {
        path: "/print/:data",
        name: "print",
        component: PrintResult
    },
];

export default new vueRouter({
    mode: "history",
    routes
});