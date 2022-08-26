<template>
    <div class="test-content">
        <div class="h2 mb-4 border-bottom">{{ testbox.name }}</div>
        <div v-if="show_result">
            <TestResult :resultRight="result_count.right" :resultTotal="result_count.total" :resultData="result_data" :testboxId="testbox.id" :student="student" :studentPos="student_pos" />
        </div>
        <div v-else>
            <div class="d-flex justify-content-between mt-3 mb-4">
                <a class="btn btn-secondary px-3" href="/tests/">Назад</a>
                <button class="btn btn-success text-white fs-5" @click.prevent="submitResult" v-if="test_finish">Завершить</button>
                <button class="btn btn-success text-white fs-5" data-bs-toggle="modal" data-bs-target="#modal-warning" v-else>Завершить</button>
            </div>
            <nav>
                <ul class="pagination">
                    <li class="page-item" :class="{'decided': t.disabled, 'active': active_id == t.id}" aria-current="page" v-for="(t, index) in arr_test" :key="t.id">
                        <a class="page-link" href="" @click.prevent="getTest(t.id)">{{ index + 1 }}</a>
                    </li>
                </ul>
            </nav>
            <div class="card mb-5">
                <div class="card-body">
                    <div class="card-title h5 fw-bold">{{ test.name }}</div>
                    <p class="card-text">{{ test.note }}</p>
                    <ul class="list-group list-group-flush test-items__list">
                        <li class="list-group-item test-items__item" v-for="item in test.items" :key="item.id">
                            <input class="form-check-input" type="radio" :name="'test-item-'+test.id" :id="'test-item-'+item.id" @change="getResult(test.id, item.id)" :checked="item.checked" v-if="item.input === 'radio'">
                            <input class="form-check-input" type="checkbox" :name="'test-item-'+item.id" :id="'test-item-'+item.id" @change="getResult(test.id, item.id)" :checked="item.id === result[test.id]" v-if="item.input === 'checkbox'">
                            <label class="form-check-label ms-2" :for="'test-item-'+item.id">{{ item.text }}</label>
                        </li>
                    </ul>
                    <!-- <input type="hidden" v-model="form_result" name="" :value="result"> -->
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-warning" tabindex="-1" role="dialog" aria-labelledby="modal-warning" aria-hidden="true" v-if="!test_finish">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content text-center py-4 px-4">
                    <div class="h5 modal-title mb-3">Необходимо ответить на все вопросы</div>
                    <div class="modal-button">
                        <button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">Понятно</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import TestResult from "../components/TestResult";
    export default {
        data: () => ({
            loading: true,
            error_del: false,
            testbox: [],
            tests: [],
            arr_test: [],
            arr_items: [],
            items: [{
                qid: "",
                data: ""
            }],
            test: [],
            active_id: 0,
            result: [],
            result_data: [],
            result_count: [{
                total:0,
                right:0,
                wrong:0
            }],
            show_result: false,
            test_finish: false,
            student: "",
            student_pos: ""
        }),
        components: {
            TestResult
        },
        mounted() {
            this.loadTest(this.$route.params.id);
        },
        methods: {
            loadTest(id) {
                axios.get('/api/test/' + id)
                .then(res => {
                    this.loading = false;
                    this.tests = res.data.tests;
                    this.testbox = res.data.testbox;

                    for(var i=0; i<res.data.tests.length; i++){
                        var data_items = res.data.test_items[i];
                        let new_data_items = [];
                        var nn=0;
                        let inp;

                        for(let t in data_items){ 
                            if(data_items[t].status == 'y') nn++;
                        }
                        
                        if(nn > 1) inp = 'checkbox' 
                                else inp = 'radio';

                        for(let t in data_items){
                            new_data_items.push({
                                id: data_items[t].id,
                                text: data_items[t].text,
                                input: inp,
                                checked: false
                            })
                        }

                        this.arr_test.push({
                            id: res.data.tests[i].id,
                            name: res.data.tests[i].name,
                            note: res.data.tests[i].note,
                            items: new_data_items,
                            disabled: false,
                        });
                    }

                    for(var n=0; n<this.arr_test.length; n++){
                        if(n == 0) {
                            this.test = this.arr_test[n];
                            this.active_id = this.arr_test[n].id
                        }
                    }

                }).catch(err => {
                    console.log(err);
                })
            },
            getTest(id) {
                this.test = this.arr_test.find(el => el.id == id);
                this.active_id = id;
            },
            getResult(qid, item_id) {
                var arr_result = [];
                if(qid && item_id){

                    this.arr_test.map(function(e){
                        if(e.id == qid){
                            for(let i=0; i<e.items.length; i++){
                                if(e.items[i].input == 'radio'){
                                    if(e.items[i].id == item_id) 
                                        e.items[i].checked = true;
                                    else
                                        e.items[i].checked = false;
                                }
                            }
                            e.disabled = true;
                        }
                    });

                    if(this.result.length){
                        this.result.map(function(e){
                            e[qid] = item_id
                        });
                    }else{
                        this.result.push({
                            [qid]: item_id
                        });
                    }

                    var arr_test_disabled = this.arr_test.some(el => el.disabled == false);

                    if(!arr_test_disabled){
                        this.test_finish = true;
                    }else{
                        this.test_finish = false;
                    }

                }
            },
            submitResult() {
                var id = this.$route.params.id;

                var arr_test_disabled = this.arr_test.some(el => el.disabled == false);

                if(!arr_test_disabled){
                    var json_data = JSON.stringify({result: this.result});
                    axios.post('/api/test_box/' + id + '/result', json_data, {
                        headers: {
                            "Content-type": "application/json"
                        }
                    })
                    .then(res => {
                        if(res.data) {

                            var result_data = res.data.result_data;

                            this.show_result = true;
                            this.result_data = result_data;
                            this.student = res.data.student.name;
                            this.student_pos = res.data.student.position;

                            var r = 0, w = 0;
                            for(var i in result_data){
                                if(result_data[i].status) r++;
                                if(result_data[i].status == false) w++;
                            }
                            this.result_count.total = Object.keys(result_data).length;
                            this.result_count.right = r;
                            this.result_count.wrong = w;
                            // console.log(res.data);
                            console.log(result_data);
                        }
                    }).catch(err => {
                        console.log(err);
                    })
                }

            }
        }
    }
</script>