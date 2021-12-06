<template>
    <div class="test-content">
        <!-- <div class="card mb-5" v-for="(test, index) in arr_test" :key="test.id" :if="index == 1">
            <div class="card-body">
                <h5 class="card-title">{{ test.name }}</h5>
                <p class="card-text">{{ test.note }}</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" v-for="item in test.items" :key="item.id">
                        <input class="form-check-input" type="radio" :name="'test-item-'+test.id" :id="'test-item-'+item.id">
                        <label class="form-check-label" :for="'test-item-'+item.id">{{ item.text }}</label>
                    </li>
                </ul>
            </div>
        </div> -->
        <nav>
            <ul class="pagination">
                <li class="page-item" aria-current="page" v-for="(t, index) in arr_test" :key="t.id">
                    <a class="page-link" href="" @click.prevent="getTest(t.id)">{{ index + 1 }}</a>
                </li>
                <!-- <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li> -->
            </ul>
        </nav>
        <div class="card mb-5">
            <div class="card-body">
                <h5 class="card-title">{{ test.name }}</h5>
                <p class="card-text">{{ test.note }}</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" v-for="item in test.items" :key="item.id">
                        <input class="form-check-input" type="radio" :name="'test-item-'+test.id" :id="'test-item-'+item.id">
                        <label class="form-check-label" :for="'test-item-'+item.id">{{ item.text }}</label>
                    </li>
                </ul>
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
            tests: [],
            arr_test: [],
            arr_items: [],
            items: [{
                qid: "",
                data: ""
            }],
            test: {
                // id: "",
                // name: "",
                // note: ""
            }
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

                    for(var i in res.data.tests){
                        if(i == 0) this.test = res.data.tests[i];
                        this.arr_test.push({
                            id: res.data.tests[i].id,
                            name: res.data.tests[i].name,
                            note: res.data.tests[i].note,
                            items: res.data.test_items[i]
                        });
                    }

                    // console.log('arr_test', this.arr_test);
                }).catch(err => {
                    // this.not_found = true;
                    console.log(err);
                })
            },
            getTest(id) {
                // if(id){
                //     var qid = id;
                // }else{
                //     var qid = test
                // }

                this.test = this.arr_test.find(el => el.id == id);

                // console.log(this.test);

                // axios.get('/api/tests/q/edit/' + id)
                // .then(res => {
                //     console.log(res.data);
                //     this.test = res.data;
                // }).catch(err => {
                //     console.log(err);
                // })
            },
            loadTestItems(id) {
                // console.log(id);
                var arr_test_items = [];
                axios.get('/api/test/q/' + id)
                .then(res => {
                    // console.log(res.data);
                    this.loading = false;
                    // this.items = res.data;
                    // for(var i in res.data){
                    //     if(res.data[i].test_id == id){
                            
                    //     }
                    // }
                    for(var i in res.data){
                        arr_test_items.push({
                            id: res.data[i].id,
                            text: res.data[i].text,
                            status: res.data[i].status
                        });
                    }
                    //setTimeout(() => { }, 500)
                }).catch(err => {
                    // this.not_found = true;
                    console.log(err);
                })
                return arr_test_items;
            }
        }
    }
</script>