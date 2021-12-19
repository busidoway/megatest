<template>
    <div>
        <div class="py-4">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="#">
                            <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><router-link :to="{path: '/admin/tests'}">Тесты</router-link></li>
                    <li class="breadcrumb-item active" aria-current="page">Создание вопроса</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between w-100 flex-wrap mb-3">
                <div class="mb-3 mb-lg-0">
                    <h1 class="h4">Создание вопроса</h1>
                </div>
            </div>
            <div>
                <router-link class="btn btn-gray-800 px-4" :to="{path: '/admin/tests/' + form.test_box_id}"><i class="fas fa-arrow-left me-2"></i> Назад</router-link>
            </div>
        </div>
        <div class="row">
            <div class="col-6 mb-4">
                <div class="card border-0 shadow components-section">
                    <div class="card-body">
                        <transition name="fade" :duration="{ enter: 500, leave: 300 }">
                        <div class="row mx-0 text-white bg-danger px-3 py-2 rounded position-absolute end-0" style="transform: translateY(-100%); top:-15px;" v-if="state.form.error">
                            Ошибка
                        </div>
                        </transition>
                        <transition name="fade" :duration="{ enter: 500, leave: 4000 }">
                        <div class="row mx-0 text-white bg-success px-3 py-2 rounded position-absolute end-0" style="transform: translateY(-100%); top:-15px;" v-if="state.form.success">
                            Успешно сохранено
                        </div>
                        </transition>
                        <form>
                            <input type="hidden" name="test_box_id" v-model="form.test_box_id" value="">
                            <div class="row mx-0">
                                <textarea name="name" id="nameTest" v-model="form.name" :class="[{ 'is-invalid':state.form.error, 'form-control-disabled':state.form.disabled }]" class="form-control" placeholder="Заголовок" @input="changeName(form.name)" style="height:2rem" required></textarea>
                            </div>
                            <div class="d-flex justify-content-end mb-3">
                                <button class="btn py-0 px-2 " :class="[{ 'text-success':!state.btnName.disabled, 'text-gray-300':state.btnName.disabled }]" @click.prevent="store" :disabled="state.btnName.disabled"><i class="fas fa-check"></i> Сохранить</button>
                                <!-- <button class="btn py-0 px-2 text-danger ms-1" ><i class="fas fa-times"></i></button> -->
                            </div>
                        </form>
                        <form>
                            <div class="row mx-0">
                                <textarea name="note" id="noteTest" rows="10" v-model="formNote.note" class="form-control" :class="[{ 'form-control-disabled':state.formNote.disabled }]" @input="changeNote(formNote.note)" placeholder="Описание"></textarea>
                            </div>
                            <div class="d-flex justify-content-end mb-3">
                                <button class="btn py-0 px-2 " :class="[{ 'text-success':!state.btnNote.disabled, 'text-gray-300':state.btnNote.disabled }]" @click.prevent="updateNote" :disabled="state.btnNote.disabled">
                                    <i class="fas fa-check"></i> Сохранить</button>
                                <button class="btn py-0 px-2 text-warning ms-1" @click.prevent="clearNote"><i class="fas fa-times"></i> Очистить</button>
                            </div>
                            <!-- <div class="row p-0 mx-0">
                                <div class="p-0">
                                    <button class="btn btn-success" @click.prevent="store">Сохранить</button>     
                                    <router-link :to="{path: '/admin/tests'}" class="btn btn-default">Назад</router-link>
                                </div>
                            </div> -->
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-6 mb-4">
                <div class="card border-0 shadow components-section">
                    <div class="card-body">
                        <transition name="fade" :duration="{ enter: 500, leave: 300 }">
                        <div class="row mx-0 text-white bg-danger px-3 py-2 rounded position-absolute end-0" style="transform: translateY(-100%); top:-15px;" v-if="state.iform.error">
                            Ошибка
                        </div>
                        </transition>
                        <transition name="fade" :duration="{ enter: 500, leave: 4000 }">
                        <div class="row mx-0 text-white bg-success px-3 py-2 rounded position-absolute end-0" style="transform: translateY(-100%); top:-15px;" v-if="state.iform.success">
                            Успешно сохранено
                        </div>
                        </transition>
                        <!-- <TestItems></TestItems> -->
                        <div class="row mb-2 mx-0 h5">
                            <b>Ответы</b>
                        </div>
                        <div class="test-items py-2 mb-5">
                            <div class="row m-0" v-for="(item, index) in items" :key="item.label">
                                <form>
                                    <div class="d-flex align-items-center">
                                        <span class="me-1 test-items__num" :if="item.label">{{ index + 1 }}:</span>
                                        <input type="checkbox" :name="'checkitem'+item.label" :id="'checkitem'+item.label" v-model="item.status" class="form-check-input my-0 ms-2 me-3" @change="changeItem(index, item.value, item.status)" :checked="item.status">
                                        <textarea :name="'item' + item.label" v-model="item.value" :class="{ 'is-invalid':item.error, 'form-control-disabled':item.disabled }" class="form-control" style="height:2rem" @input="changeItem(index, item.value)" v-on:keyup.enter.prevent="storeItem(item.label, item.id, item.value, item.status, $event)" @keydown.enter.prevent=""></textarea>
                                        <!-- <input type="hidden" name="status" v-model="iform.status" value="n"> -->
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button class="btn py-0 px-2" :class="[{ 'btn-text-gray': item.btnDisabled, 'text-success': !item.btnDisabled  }]" :disabled="item.btnDisabled" @click.prevent="storeItem(item.label, item.id, item.value, item.status)" title="Сохранить">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button class="btn py-0 px-2 text-danger ms-2" @click.prevent="deleteItem(index, item.id)" title="Удалить"><i class="fas fa-times"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="py-0 row m-0">
                                <div>
                                    <button class="btn px-0 m-0" :class="[{ 'btn-text-gray': state.btnAddItem.disabled, 'text-info': !state.btnAddItem.disabled  }]" :disabled="state.btnAddItem.disabled" @click.prevent="addItem">
                                        <i class="fas fa-plus"></i> Добавить пункт
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    // import TestItems from "../components/AdminTestItems.vue";

    export default {
        components: {
            // TestItems
        },
        data: () => ({
            form: {
                test_box_id: "",
                name: ""
            },
            formNote: {
                test_box_id: "",
                note: ""
            },
            testEditVal: [],
            items: [],
            iform: {
                test_id: "",
                text: "",
                status: ""
            },
            state: {
                form: {
                    error: false,
                    success: false,
                    disabled: false
                },
                formNote: {
                    disabled: true
                },
                iform: {
                    error: false,
                    success: false
                },
                btnName: {
                    disabled: false
                },
                btnNote: {
                    disabled: false
                },
                btnAddItem: {
                    disabled: false
                }
            },
            settings: {
                duration: 4000
            }
        }),
        mounted() {
            this.editTest(this.$route.params.qid);
            this.editItems(this.$route.params.qid);
            this.form.test_box_id = this.$route.params.id;
            this.visibleBtnAddItem(this.$route.params.qid);
        },
        methods: {
            store() {
                var id = this.$route.params.id;
                
                if(this.$route.params.qid){
                    var qid = this.$route.params.qid;
                }

                this.form.test_box_id = id;

                if(!qid){
                    axios.post('/api/tests/' + id + '/q', this.form, {
                        headers: {
                            "Content-type": "application/json"
                        }
                    })
                    .then(res => {
                        // console.log(res.data);
                        if (res.data.status) {
                            this.state.form.success = true;
                            this.state.form.error = false;
                            this.$router.push('/admin/tests/'+ this.$route.params.id +'/q/'+ res.data.test.id);
                            this.state.form.disabled = true;
                            this.state.btnName.disabled = true;
                            this.state.btnAddItem.disabled = false;
                            // console.log('qid:',this.$route.params.qid);
                            setTimeout(() => { this.state.form.success = false; }, this.settings.duration);
                        } else {
                            this.state.form.error = true;
                            this.state.form.success = false;
                        }
                    })
                }else{
                    axios.post('/api/tests/' + id + '/q/' + qid, this.form, {
                        headers: {
                            "Content-type": "application/json"
                        }
                    })
                    .then(res => {
                        console.log(res.data);
                        if (res.data.status) {
                            this.state.form.success = false;
                            this.state.form.success = true;
                            this.state.form.error = false;
                            this.state.btnName.disabled = true;
                            this.state.form.disabled = true;
                            setTimeout(() => { this.state.form.success = false; }, this.settings.duration);
                        } else {
                            this.state.form.error = true;
                            this.state.form.success = false;
                        }
                    })
                }
            },
            updateNote() {
                var id = this.$route.params.id;
                if(this.$route.params.qid){
                    var qid = this.$route.params.qid;
                }

                if(qid){
                    axios.post('/api/tests/q/note/' + qid, this.formNote, {
                        headers: {
                            "Content-type": "application/json"
                        }
                    })
                    .then(res => {
                        if (res.data.status) {
                            this.state.form.success = false;
                            this.state.form.success = true;
                            this.state.form.error = false;
                            this.state.formNote.disabled = true;
                            this.state.btnNote.disabled = true;
                            setTimeout(() => { this.state.form.success = false; }, this.settings.duration);
                        } else {
                            this.state.form.error = true;
                            this.state.form.success = false;
                        }
                    })
                }
            },
            editTest(qid) {
                if(qid){
                    axios.get('/api/tests/q/edit/' + qid)
                    .then(res => {
                        this.testEditVal = res.data;
                        if(res.data.name) this.form.name = res.data.name;
                        if(res.data.note) this.formNote.note = res.data.note;
                        this.state.form.disabled = true;
                        this.state.btnName.disabled = true;
                        this.state.btnNote.disabled = true;
                    }).catch(err => {
                        // this.not_found = true;
                        console.log(err);
                    })
                }
            },
            storeItem(label, itemid, val, status, event) {
                var id = this.$route.params.id,
                    qid = this.$route.params.qid,
                    indexid = label - 1;
                
                this.iform.test_id = qid;
                this.iform.text = val;

                if(status)
                    this.iform.status = 'y';
                else
                    this.iform.status = 'n';

                if(!itemid) itemid = 0;

                if(val){
                    axios.post('/api/tests/q/' + qid + '/item/' + itemid, this.iform, {
                        headers: {
                            "Content-type": "application/json"
                        }
                    })
                    .then(res => {
                        // console.log('data items:', this.items);
                        if (res.data.status) {
                            this.state.iform.success = true;
                            this.state.iform.error = false;
                            // console.log('this.items:',this.items[indexid]);
                            this.items[indexid].disabled = true;
                            this.items[indexid].btnDisabled = true;
                            if(event) event.target.blur();
                            if(status) 
                                this.items[indexid].status = true;
                            else
                                this.items[indexid].status = false;
                            
                            setTimeout(() => { this.state.iform.success = false; }, this.settings.duration);
                        } else {
                            this.state.iform.error = true;
                            this.state.iform.success = false;
                        }
                    })
                }else{
                    this.items[indexid].error = true;
                }
            },
            editItems(qid) {
                if(qid){
                    axios.get('/api/tests/q/edit/' + qid + '/items')
                    .then(res => {
                        if(res.data){
                            // console.log(res.data);
                            for(let i in res.data){
                                if( res.data[i].status == 'y')
                                    var status = true;
                                else
                                    var status = false;
                                this.items.push({
                                    id: res.data[i].id,
                                    label: this.items.length + 1,
                                    value: res.data[i].text,
                                    status: status,
                                    disabled: true,
                                    error: false,
                                    success: true,
                                    btnDisabled: true
                                })
                            }
                            // console.log(this.items);
                        }
                    }).catch(err => {
                        this.state.iform.error = true;
                        this.state.iform.success = false;
                    })
                }
            },
            deleteItem(index, id) {
                if(id) {
                    axios.get('/api/test/items/del/'+id)
                    .then(res => {
                        if(res.status){
                            this.items.splice(index, 1);
                        }else{
                            this.state.iform.error = true;
                            this.state.iform.success = false;
                        }
                    })
                    .catch(err => {
                        this.error_del = true;
                    })
                }else{
                    this.items.splice(index, 1);
                }
            },
            addItem() {
                this.items.push({
                    id: "",
                    label: this.items.length + 1,
                    value: '',
                    status: '',
                    error: false,
                    disabled: false,
                    success: false,
                    btnDisabled: true
                })
            },
            changeName(inp) {
                if(inp) {
                    this.state.form.disabled = false;
                    this.state.btnName.disabled = false;
                }
            },
            changeNote(inp) {
                if(inp) {
                    this.state.formNote.disabled = false;
                    this.state.btnNote.disabled = false;
                }
            },
            changeItem(index, inp, status) {
                if(inp) {
                    this.items[index].btnDisabled = false;
                    this.items[index].disabled = false;
                    if(status)
                        this.items[index].status = status;
                }
                // console.log(this.items);
            },
            clearNote() {
                this.formNote.note = "";
                this.state.btnNote.disabled = false;
            },
            visibleBtnAddItem(qid){
                console.log(qid);
                if(qid)
                    this.state.btnAddItem.disabled = false
                else
                    this.state.btnAddItem.disabled = true
            }
        }
    }
</script>