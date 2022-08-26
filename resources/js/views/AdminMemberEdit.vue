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
                    <li class="breadcrumb-item"><router-link :to="{path: '/admin/members'}">Члены комиссии</router-link></li>
                    <li class="breadcrumb-item active" aria-current="page">Добавление члена</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between w-100 flex-wrap mb-3">
                <div class="mb-3 mb-lg-0">
                    <h1 class="h4">Добавление члена</h1>
                </div>
            </div>
            <div>
                <button class="btn btn-gray-800 px-4" @click="$router.go(-1)"><i class="fas fa-arrow-left me-2"></i> Назад</button>
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
                            <div class="row mx-0 mb-4">
                                <input type="text" name="name" id="nameMember" v-model="form.name" :class="[{ 'is-invalid':state.form.error, 'form-control-disabled':state.form.disabled }]" class="form-control" placeholder="Ф.И.О." @input="changeName(form.name)" required>
                            </div>
                            <div class="row mx-0 mb-3">
                                <input type="text" name="position" id="positionMember" v-model="form.position" :class="[{ 'is-invalid':state.form.error, 'form-control-disabled':state.form.disabled }]" class="form-control" placeholder="Должность" @input="changePosition(form.position)">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn py-0 px-2 " :class="[{ 'text-success':!state.btnName.disabled, 'text-gray-300':state.btnName.disabled }]" @click.prevent="store" :disabled="state.btnName.disabled"><i class="fas fa-check"></i> Сохранить</button>
                                <!-- <button class="btn py-0 px-2 text-danger ms-1" ><i class="fas fa-times"></i></button> -->
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
                name: "",
                position: ""
            },
            state: {
                error: false,
                success: false,
                form: {
                    error: false,
                    success: false,
                    disabled: false
                },
                btnName: {
                    disabled: false
                }
            },
            settings: {
                duration: 4000
            }
        }),
        mounted() {
            this.editMember(this.$route.params.id);
        },
        methods: {
            store() {
                var id = this.$route.params.id;
                var api_rout;

                if(id) {
                    api_rout = '/api/member/update/' + id;
                }else{
                    api_rout = '/api/member/store';
                }

                axios.post(api_rout, this.form, {
                    headers: {
                        "Content-type": "application/json"
                    }
                })
                .then(res => {
                    if (res.data.status) {
                        if(res.data.store) this.$router.push('/admin/member/'+ res.data.member.id);
                        this.state.error = false;
                        this.state.success = true;
                        this.state.btnName.disabled = true;
                        this.state.form.disabled = true;
                        setTimeout(() => { this.state.success = false; }, this.settings.duration);
                    } else {
                        this.state.form.success = false;
                        this.state.form.error = true;
                    }
                }).catch(err => {
                    this.state.success = false;
                    this.state.error = true;
                })
            },
            editMember(id) {
                if(id){
                    axios.get('/api/member/edit/' + id)
                    .then(res => {
                        if(res.data.name) this.form.name = res.data.name;
                        if(res.data.position) this.form.position = res.data.position;
                        this.state.form.disabled = true;
                        this.state.btnName.disabled = true;
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
            changePosition(inp) {
                if(inp) {
                    this.state.form.disabled = false;
                    this.state.btnName.disabled = false;
                }
            }
        }
    }
</script>