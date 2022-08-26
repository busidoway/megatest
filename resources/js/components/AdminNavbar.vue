<template>
    <ul class="nav flex-column pt-3 pt-md-0">
        <li class="nav-item">
            <a href="/" class="nav-link d-flex align-items-center">
            <span class="sidebar-icon">
                <img src="/assets/img/brand/light.svg" height="20" width="20" alt="MegaTest">
            </span>
            <span class="mt-1 ms-1 sidebar-text">MegaTest</span>
            </a>
        </li>
        <li v-for="link in links" :key='link.id' class="nav-item">
            <router-link :to="link.href" class="nav-link">
                <span class="sidebar-icon">
                    <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" v-html="link.code"></svg>
                </span> 
                <span class="sidebar-text">{{ link.title }}</span>
            </router-link>
        </li>
    </ul>
</template>

<script>
    export default {
        data() {
            return {
                links: [
                    {
                        title: "Тесты",
                        href: "/admin/tests",
                        code: '<path  d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path  d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z">'
                    },
                    {
                        title: "Сотрудники",
                        href: "/admin/students",
                        code: '<path  d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path  d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z">'
                    },
                    {
                        title: "Члены комиссии",
                        href: "/admin/members",
                        code: '<path  d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path  d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z">'
                    },
                ]
            }
        }
    }
</script>