<template>
    <div class="admin-tests">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item">
                            <router-link :to="{path: '/admin/index'}">
                                <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            </router-link>
                        </li>
                        <li class="breadcrumb-item">
                            <router-link :to="{path: '/admin/tests'}">Тесты</router-link>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Вопросы</li>
                    </ol>
                </nav>
                <h2 class="h4">Вопросы</h2>
                <p class="mb-0">Список вопросов.</p>
            </div>
            
        </div>
        <div class="mb-4 d-flex justify-content-between">
            <router-link class="btn btn-gray-800 px-4" :to="{path: '/admin/tests'}"><i class="fas fa-arrow-left me-2"></i> Назад</router-link>
            <div class="btn-toolbar mb-2 mb-md-0">
                <button @click="goToEditQuestion()" class="btn btn-sm btn-secondary d-inline-flex align-items-center">
                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Добавить вопрос
                </button>
            </div>
        </div>
        <div class="table-settings mb-4">
            <div class="row align-items-center justify-content-between">
                <div class="col col-md-6 col-lg-3 col-xl-4">
                    <div class="input-group me-2 me-lg-3 fmxw-400">
                        <span class="input-group-text">
                            <svg class="icon icon-xs" x-description="Heroicon name: solid/search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                        </span>
                        <input type="text" class="form-control" placeholder="Поиск">
                    </div>
                </div>
                <div class="col-4 col-md-2 col-xl-1 ps-md-0 text-end">
                    <div class="dropdown">
                        <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg>
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end pb-0">
                            <span class="small ps-3 fw-bold text-dark">Show</span>
                            <a class="dropdown-item d-flex align-items-center fw-bold" href="#">10 <svg class="icon icon-xxs ms-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></a>
                            <a class="dropdown-item fw-bold" href="#">20</a>
                            <a class="dropdown-item fw-bold rounded-bottom" href="#">30</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-danger" v-if="error_del">
            Ошибка удаления
        </div>
        <div class="card card-body border-0 shadow table-wrapper table-responsive">
                <div class="d-flex justify-content-center position-absolute top-50 start-50 translate-middle" v-if="loading">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="border-gray-200">#</th>
                            <th class="border-gray-200">Заголовок</th>						
                            <!-- <th class="border-gray-200">Дата</th> -->
                            <th class="border-gray-200">Статус</th>
                            <th class="border-gray-200"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Item -->
                        <tr v-for="(test, index) in tests" :key="test.id">
                            <td>
                                <a href="#" class="fw-bold" :data-num="index">
                                    {{ test.label }}
                                </a>
                            </td>
                            <td>
                                <router-link :to="{path: '/admin/tests/' + test_box_id + '/q/' + test.id}" class="text-info"><span class="fw-normal">{{ test.name }}</span></router-link>
                            </td>
                            <!-- <td><span class="fw-normal">{{ test.created_at }}</span></td> -->
                            <td><span class="fw-bold text-success">Активный</span></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="icon icon-sm">
                                            <span class="fas fa-ellipsis-h icon-dark"></span>
                                        </span>
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu py-0">
                                        <!-- <a class="dropdown-item rounded-top" href="javascript:;"><span class="fas fa-eye me-2"></span>Просмотр</a> -->
                                        <!-- <a class="dropdown-item" href="javascript:;"><span class="fas fa-edit me-2"></span>Редактировать</a> -->
                                        <a class="dropdown-item text-danger rounded-bottom" href="javascript:;" @click="getTestId(test.id)" data-bs-toggle="modal" data-bs-target="#modal-remove"><span class="fas fa-trash-alt me-2"></span>Удалить</a>
                                    </div>
                                </div>
                            </td>
                        </tr>                                
                    </tbody>
                </table>
                <div class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
                    <Pagination :total="total" :item="count_tests" @page-changed="loadListTests"/>
                    <div class="fw-normal small mt-4 mt-lg-0">Отображено <b>{{ curr_count }}</b> из <b>{{ total }}</b> записей</div>
                </div>
            </div>
            <div class="modal fade" id="modal-remove" tabindex="-1" role="dialog" aria-labelledby="modal-remove" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="h6 modal-title">Подтверждение удаления</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" @click.prevent="deleteTest(test.q.id)" data-bs-dismiss="modal">Удалить</button>
                            <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal">Отмена</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import Pagination from "../components/Pagination";
    export default {
        data: () => ({
            loading: true,
            error_del: false,
            tests: [],
            test_box_id: "",
            test: {
                q: {
                    id: ""
                }
            },
            tests_data: [],
            page: 1,
            total: 0,
            count_tests: 10,
            curr_count: 0
        }),
        components: {
            Pagination
        },
        mounted() {
            this.loadTests(this.$route.params.id);
            this.loadListTests(this.page)
        },
        methods: {
            loadTests(id) {
                var page = this.$route.params.page;
                var arr_test = [];
                axios.get('/api/tests/' + id)
                .then(res => {
                    this.loading = false;

                    for(var i=0; i<res.data.length; i++){
                        arr_test.push({
                            label: i + 1,
                            created_at: res.data[i].created_at,
                            id: res.data[i].id,
                            name: res.data[i].name,
                            note: res.data[i].note,
                            test_box_id: res.data[i].test_box_id,
                            updated_at: res.data[i].updated_at,
                        });
                    }

                    this.tests = arr_test;
                    this.test_box_id = id;
                    this.tests_data = arr_test;
                    this.curr_count = res.data.length;
                    this.total = res.data.length;
                    if(page){
                        this.loadListTests(page)
                    }else if(this.total > this.count_tests){
                        this.loadListTests(1)
                    }
                    //setTimeout(() => { }, 500)
                }).catch(err => {
                    // this.not_found = true;
                    console.log(err);
                })
            },
            goToEditQuestion(){
                this.$router.push('/admin/tests/'+ this.$route.params.id +'/q');
            },
            getTestId(id) {
                if(id) this.test.q.id = id;
            },
            deleteTest(id){
                var test_box_id = this.$route.params.id;
                // console.log(id);
                axios.get('/api/tests/del/'+id)
                .then(res => {
                    if(res.data.status)
                        this.loadTests(test_box_id);
                    else
                        this.error_del = true;
                })
                .catch(err => {
                    this.error_del = true;
                })
            },
            loadListTests(pageNumber){
                var test_box_id = this.$route.params.id;
                var path = '/admin/tests/' + test_box_id + '/page/'+pageNumber;
                var start_page = (this.count_tests * pageNumber) - this.count_tests;
                var end_page = pageNumber * this.count_tests;
                var arr_tests = [];
                var n = 0;
                for(var i=0; i<this.tests_data.length; i++){
                    if(i >= start_page && i < end_page){
                        n++;
                        arr_tests.push(this.tests_data[i]);
                    }
                }
                // console.log(arr_tests);
                this.tests = arr_tests;
                this.curr_count = n;
                if (this.$route.path !== path){
                    this.$router.push('/admin/tests/' + test_box_id + '/page/'+pageNumber);
                }
            }
        }
    }
</script>