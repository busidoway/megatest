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
                    <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" v-html="link.code"><!--path  d="link.d1"></path><path  d="link.d2"></path--></svg>
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
                        title: 'Аналитика',
                        href: '/index',
                        code: '<path  d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path  d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z">'
                    },
                    {
                        title: "Тесты",
                        href: "/tests",
                        code: '<path  d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path  d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z">'
                    },
                    {
                        title: "Настройки",
                        href: "/setting",
                        code: '<path  d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"></path>'
                    }
                ]
            }
        }
    }
</script>