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
            <div class="d-flex justify-content-between w-100 flex-wrap">
                <div class="mb-3 mb-lg-0">
                    <h1 class="h4">Создание теста</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8 mb-4">
                <div class="card border-0 shadow components-section">
                    <div class="card-body">
                        <div class="row mb-3 mx-0 text-danger" v-if="error">
                            Потрачено
                        </div>
                        <div class="row mb-3 mx-0 text-success" v-if="success">
                            Успешно сохранено
                        </div>
                        <form>
                            <div class="row mb-3 mx-0">
                                <input type="text" name="name" id="nameTest" v-model="form.name" :class="{ 'is-invalid':error }" class="form-control" placeholder="Заголовок" required>
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
                note: ""
            },
            error: false,
            success: false
        }),
        methods: {
            store() {
                axios.post('/api/tests', this.form, {
                    headers: {
                        "Content-type": "application/json"
                    }
                })
                .then(res => {
                    console.log('111');
                    if (res.data.status) {
                        this.success = true;
                        this.error = false;
                    } else {
                        this.error = true;
                        this.success = false;
                    }
                })
            }
        }
    }
</script>