<template>
    <div class="test-content">
        <div class="h2 mb-4 border-bottom">{{ testbox.name }}</div>
        <div v-if="show_result">
            <div class="card mb-5" v-for="data in result_data" :key="data.name">
                <div class="card-body" :class="{'text-success':data.status, 'text-danger':!data.status}">
                    <h5 class="card-title">{{ data.name }}</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <span><i class="fas me-2" :class="{'fa-check text-success':data.status, 'fa-times text-danger':!data.status}"></i>{{ data.item }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3 mb-4">
                <a class="btn btn-secondary px-3" href="/tests/">Назад</a>
            </div>
        </div>
        <div v-else>
            <div class="d-flex justify-content-between mt-3 mb-4">
                <a class="btn btn-secondary px-3" href="/tests/">Назад</a>
                <button class="btn btn-success text-white fs-5" @click.prevent="submitResult">Завершить</button>
            </div>
            <nav>
                <ul class="pagination">
                    <li class="page-item" :class="{'active': active_id == t.id}" aria-current="page" v-for="(t, index) in arr_test" :key="t.id">
                        <a class="page-link" href="" @click.prevent="getTest(t.id)">{{ index + 1 }}</a>
                    </li>
                </ul>
            </nav>
            <div class="card mb-5">
                <div class="card-body">
                    <h5 class="card-title">{{ test.name }}</h5>
                    <p class="card-text">{{ test.note }}</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item" v-for="item in test.items" :key="item.id">
                            <input class="form-check-input" type="radio" :name="'test-item-'+test.id" :id="'test-item-'+item.id" @change="getResult(test.id, item.id)" :checked="item.checked" v-if="item.input === 'radio'">
                            <input class="form-check-input" type="checkbox" :name="'test-item-'+item.id" :id="'test-item-'+item.id" @change="getResult(test.id, item.id)" :checked="item.id === result[test.id]" v-if="item.input === 'checkbox'">
                            <label class="form-check-label ms-2" :for="'test-item-'+item.id">{{ item.text }}</label>
                        </li>
                    </ul>
                    <!-- <input type="hidden" v-model="form_result" name="" :value="result"> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
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
            show_result: false
        }),
        mounted() {
            this.loadTest(this.$route.params.id);
        },
        methods: {
            loadTest(id) {
                // console.log(id);
                axios.get('/api/test/' + id)
                .then(res => {
                    // console.log(res.data);
                    this.loading = false;
                    this.tests = res.data.tests;
                    this.testbox = res.data.testbox;

                    for(var i=0; i<res.data.tests.length; i++){
                        // var data_items = [];
                        var data_items = res.data.test_items[i];
                        let new_data_items = [];
                        // let qid = res.data.test_items[i].id;
                        // console.log(res.data.test_items[i]);
                        var nn=0;
                        let inp;
                        for(let t in data_items){ 
                            if(data_items[t].status == 'y') nn++;
                        }
                        
                        if(nn > 1) inp = 'checkbox' 
                                else inp = 'radio';

                        for(let t in data_items){
                            // let checked = false;
                            // let check = this.result.find(el => el[qid] == data_items[t].id);
                            // if(check) checked = true;
                            new_data_items.push({
                                id: data_items[t].id,
                                text: data_items[t].text,
                                status: data_items[t].status,
                                input: inp,
                                checked: false
                            })
                        }
                        
                        // console.log(new_data_items);

                        this.arr_test.push({
                            id: res.data.tests[i].id,
                            name: res.data.tests[i].name,
                            note: res.data.tests[i].note,
                            // items: res.data.test_items[i]
                            items: new_data_items,
                        });
                    }

                    // console.log(this.arr_test);

                    for(var n=0; n<this.arr_test.length; n++){
                        if(n == 0) {
                            this.test = this.arr_test[n];
                            this.active_id = this.arr_test[n].id
                        }
                    }

                    // console.log('arr_test', this.arr_test);
                }).catch(err => {
                    // this.not_found = true;
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
                    // console.log(qid, item_id);

                    // if(this.result.length) this.result.find(el => el.qid == qid);
                    
                    // console.log(this.arr_test);

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
                        }
                    });

                    // console.log(this.arr_test);

                    // if(this.arr_test[qid].items.id == item_id) this.arr_test[qid].items.checked = true;

                    if(this.result.length){
                        this.result.map(function(e){
                            e[qid] = item_id
                        });
                    }else{
                        this.result.push({
                            [qid]: item_id
                        });
                    }

                    

                    // let new_result = this.result.find(el => el[qid]);

                    // for(let i=0; i<this.result.length; i++){
                    //     console.log(this.result[i][qid]);
                    // }

                    // let map_result = new Map();

                    // this.result.set(qid, )

                    // this.result = arr_result;
                    // console.log(this.result)
                }
            },
            submitResult() {
                var id = this.$route.params.id;
                var json_data = JSON.stringify({result: this.result});
                axios.post('/api/test_box/' + id + '/result', json_data, {
                    headers: {
                        "Content-type": "application/json"
                    }
                })
                .then(res => {
                    if(res.data) {
                        this.show_result = true;
                        this.result_data = res.data;
                        // console.log(res.data);
                    }
                }).catch(err => {
                    // this.not_found = true;
                    console.log(err);
                })

            }
        }
    }
</script>