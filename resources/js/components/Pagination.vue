<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination mb-0">
            <li class="page-item">
                <a class="page-link" href="javascript:;" @click.prevent="changePage(currentPage-1)"><i class="fas fa-angle-left"></i></a>
            </li>
            <li class="page-item" :class="{active: currentPage == p}" v-for="p in totalPages" :key="p">
                <a class="page-link" href="javascript:;" @click.prevent="changePage(p)">{{p}}</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="javascript:;" @click.prevent="changePage(currentPage+1)"><i class="fas fa-angle-right"></i></a>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        name: "Pagination",
        props: ['total', 'item'],
        data() {
            return {
                currentPage: 1
            }
        },
        mounted() {
            this.getCurrPage()
            // console.log('currentPage: ', this.currentPage);
        },
        computed: {
            totalPages() {
                return Math.ceil(this.total / this.item)
            }
        },
        methods: {
            changePage(pageNumber) {
                if(pageNumber > 0 && pageNumber <= this.totalPages){
                    this.currentPage = pageNumber
                    this.$emit('page-changed', pageNumber)
                }
            },
            getCurrPage() {
                // console.log('page: ', this.$route.params.page);
                var page = this.$route.params.page;
                if(page) this.currentPage = page;
            }
        }
    }
</script>