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
                    <li class="breadcrumb-item active" aria-current="page">Создание теста</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between w-100 flex-wrap mb-3">
                <div class="mb-3 mb-lg-0">
                    <h1 class="h4">Создание теста</h1>
                </div>
            </div>
            <div>
                <router-link class="btn btn-gray-800 px-4" :to="{path: '/admin/tests/'}"><i class="fas fa-arrow-left me-2"></i> Назад</router-link>
            </div>
        </div>
        <div class="row">
            <div class="col-8 mb-4">
                <div class="card border-0 shadow components-section">
                    <div class="card-body">
                        <transition name="fade" :duration="{ enter: 500, leave: 300 }">
                        <div class="row mx-0 text-white bg-danger px-3 py-2 rounded position-absolute end-0" style="transform: translateY(-100%); top:-15px;" v-if="state.error">
                            Ошибка
                        </div>
                        </transition>
                        <transition name="fade" :duration="{ enter: 500, leave: 4000 }">
                        <div class="row mx-0 text-white bg-success px-3 py-2 rounded position-absolute end-0" style="transform: translateY(-100%); top:-15px;" v-if="state.success">
                            Успешно сохранено
                        </div>
                        </transition>
                        <form>
                            <div class="row mx-0">
                                <textarea type="text" name="name" id="nameTest" v-model="form.name" :class="[{ 'is-invalid':state.form.error, 'form-control-disabled':state.form.disabled }]" class="form-control" placeholder="Заголовок" style="height:2rem" @input="changeName(form.name)" required></textarea>
                            </div>
                            <div class="d-flex justify-content-end mb-3">
                                <button class="btn py-0 px-2 " :class="[{ 'text-success':!state.btnName.disabled, 'text-gray-300':state.btnName.disabled }]" @click.prevent="store" :disabled="state.btnName.disabled"><i class="fas fa-check"></i> Сохранить</button>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        components: {},
        data: () => ({
            form: {
                name: ""
            },
            formNote: {
                note: ""
            },
            state: {
                error: false,
                success: false,
                form: {
                    error: false,
                    success: false,
                    disabled: false
                },
                formNote: {
                    error: false,
                    success: false,
                    disabled: true
                },
                btnName: {
                    disabled: false
                },
                btnNote: {
                    disabled: false
                }
            },
            settings: {
                duration: 4000
            }
        }),
        mounted() {
            this.editTestBox(this.$route.params.id);
        },
        methods: {
            store() {
                var id = this.$route.params.id;

                if(!id) id = 0;

                axios.post('/api/test_box/' + id, this.form, {
                    headers: {
                        "Content-type": "application/json"
                    }
                })
                .then(res => {
                    if (res.data.status) {
                        if(res.data.store) this.$router.push('/admin/test/'+ res.data.testbox.id);
                        this.state.error = false;
                        this.state.success = true;
                        this.state.btnName.disabled = true;
                        this.state.form.disabled = true;
                        setTimeout(() => { this.state.success = false; }, this.settings.duration);
                    } else {
                        this.state.success = false;
                        this.state.error = true;
                    }
                }).catch(err => {
                    this.state.success = false;
                    this.state.error = true;
                })
            },
            updateNote() {
                if(this.$route.params.id){
                    var id = this.$route.params.id;
                }

                if(id){
                    axios.post('/api/test_box/note/' + id, this.formNote, {
                        headers: {
                            "Content-type": "application/json"
                        }
                    })
                    .then(res => {
                        if (res.data.status) {
                            this.state.error = false;
                            this.state.success = false;
                            this.state.success = true;
                            this.state.form.error = false;
                            this.state.formNote.disabled = true;
                            this.state.btnNote.disabled = true;
                            setTimeout(() => { this.state.success = false; }, this.settings.duration);
                        } else {
                            this.state.formNote.success = false;
                            this.state.formNote.error = true;
                            this.state.success = false;
                            this.state.error = true;
                        }
                    }).catch(err => {
                        this.state.success = false;
                        this.state.error = true;
                    })
                }
            },
            editTestBox(id) {
                if(id){
                    axios.get('/api/test_box/edit/' + id)
                    .then(res => {
                        if(res.data.name) this.form.name = res.data.name;
                        if(res.data.note) this.formNote.note = res.data.note;
                        this.state.form.disabled = true;
                        this.state.formNote.disabled = true;
                        this.state.btnName.disabled = true;
                        this.state.btnNote.disabled = true;
                    }).catch(err => {
                        this.state.success = false;
                        this.state.error = true;
                    })
                }
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
            clearNote() {
                this.formNote.note = "";
                this.state.btnNote.disabled = false;
            }
        }
    }
</script>