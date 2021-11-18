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
            <div class="d-flex justify-content-between w-100 flex-wrap">
                <div class="mb-3 mb-lg-0">
                    <h1 class="h4">Создание вопроса</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 mb-4">
                <div class="card border-0 shadow components-section">
                    <div class="card-body">
                        <div class="row mb-3 mx-0 text-danger" v-if="state.form.error">
                            Потрачено
                        </div>
                        <div class="row mb-3 mx-0 text-success" v-if="state.form.success">
                            Успешно сохранено
                        </div>
                        <form>
                            <input type="hidden" name="test_box_id" v-model="form.test_box_id" value="">
                            <div class="row mb-3 mx-0">
                                <input type="text" name="name" id="nameTest" v-model="form.name" :class="{ 'is-invalid':state.form.error }" class="form-control" placeholder="Заголовок" required>
                            </div>
                            <div class="row mb-3 mx-0">
                                <textarea name="note" id="noteTest" rows="10" v-model="form.note" class="form-control" placeholder="Описание"></textarea>
                            </div>
                            <div class="row p-0 mx-0">
                                <div class="p-0">
                                    <button class="btn btn-success" @click.prevent="store">Сохранить</button>     
                                    <router-link :to="{path: '/admin/tests'}" class="btn btn-default">Назад</router-link>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-6 mb-4">
                <div class="card border-0 shadow components-section">
                    <div class="card-body">
                        <!-- <TestItems></TestItems> -->
                        <div class="row mb-2 mx-0">
                            <b>Ответы</b>
                        </div>
                        <div class="test-items py-2 mb-5">
                            <div class="row m-0" v-for="(item, index) in items" :key="item.label">
                                <form>
                                    <span class="me-3" :if="item.label">{{ item.label }} # {{ index + 1 }}:</span><input type="text" :name="'item' + item.label" v-model="item.value" :class="{ 'is-invalid':item.error }" class="form-control">
                                    <input type="hidden" name="status" v-model="iform.status" value="">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn py-0 px-2 text-success" @click.prevent="storeItem(item.label, item.value)"><i class="fas fa-check"></i></button>
                                        <button class="btn py-0 px-2 text-danger ms-1" @click.prevent="deleteItem(index)"><i class="fas fa-times"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="py-2">
                                <button class="btn btn-sm btn-btn btn-outline-gray-500 d-inline-flex align-items-center" @click.prevent="addItem">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="icon icon-xs me-2"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                    Добавить пункт
                                </button>
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
                name: "",
                note: ""
            },
            items: [
                { 
                    label:1,
                    value: '',
                    error: false,
                    success: false
                }
            ],
            iform: {
                test_id: "",
                text: "",
                status: ""
            },
            state: {
                form: {
                    error: false,
                    success: false
                }
            }
        }),
        methods: {
            store() {
                // console.log(this.$route.params.id);
                var id = this.$route.params.id;
                this.form.test_box_id = id;
                    
                axios.post('/api/tests/' + id + '/question', this.form, {
                    headers: {
                        "Content-type": "application/json"
                    }
                })
                .then(res => {
                    console.log(res.data);
                    if (res.data.status) {
                        this.state.form.success = true;
                        this.state.form.error = false;
                        this.$router.push('/admin/tests/'+ this.$route.params.id +'/question/'+ res.data.test.id);
                    } else {
                        this.state.form.error = true;
                        this.state.form.success = false;
                    }
                })
            },
            storeItem(itemid, val) {
                var id = this.$route.params.id,
                    qid = this.$route.params.qid,
                    itemid = itemid - 1;
                
                this.iform.test_id = qid;
                this.iform.text = val;
                this.iform.status = 'n';
                
                // console.log(this.items); 

                if(val){
                    axios.post('/api/tests/' + id + '/question/' + qid, this.iform, {
                        headers: {
                            "Content-type": "application/json"
                        }
                    })
                    .then(res => {
                        // console.log(res.data);
                        if (res.data.status) {
                            this.state.iform.success = true;
                            this.state.iform.error = false;
                        } else {
                            this.state.iform.error = true;
                            this.state.iform.success = false;
                        }
                    })
                }else{
                    this.items[itemid].error = true;
                }
            },
            deleteItem(id) {
                var itemid = id - 1
                // itemid = itemid - 1;
                this.items.splice(id, 1);
                console.log(this.items);
                // this.items.concat();
            },
            addItem() {
                this.items.push({
                    label: this.items.length + 1,
                    value: '',
                    error: false,
                    success: false
                })
            }
        }
    }
</script>