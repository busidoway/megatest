<template>
    <div class="test-result">
        <div class="mb-4 fs-5 test-result__users">
            <div class="test-result__student">
                <div class="mb-2"><b>Ф.И.О.:</b> {{ student }}</div>
                <div class=""><b>Должность:</b> {{ studentPos }}</div>
            </div>
            <div class="test-result__members noprint">
                <div class="mb-2"><b>Члены комиссии:</b></div>
                <div class="mb-2 test-result__members_item" v-for="member in members" :key="member.id">
                    <span v-if="member.position">{{ member.position }}, </span><span>{{ member.name }}</span>
                </div>
            </div>
        </div>
        <div class="py-3 mb-3 fs-4 text-center test-result__date">
            {{ date }}
        </div>
        <div class="mb-4 fs-3 text-center noprint">
            <div class="text-success" v-if="successful">
                Поздравляем! Вы успешно сдали!
            </div>
            <div class="text-danger" v-else>
                Сожалеем. Вы не сдали.
            </div>
        </div>
        <hr>
        <div class="py-3 px-3 text-center mb-3 fs-4 test-result__result">
            Правильные ответы: {{ resultRight }} из {{ resultTotal }}
        </div>
        <div class="card mb-3" v-for="data in resultData" :key="data.name">
            <div class="card-body" :class="{'text-success':data.status, 'text-danger':!data.status}">
                <h5 class="card-title">{{ data.name }}</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <span><i class="fas me-2" :class="{'fa-check text-success':data.status, 'fa-times text-danger':!data.status}"></i>{{ data.item }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3 mb-4 noprint">
            <a class="btn btn-secondary px-3" href="/tests/">На страницу тестов</a>
            <a class="btn btn-secondary px-3 ms-3" :href="'/test/'+testboxId" >Начать заново</a>
        </div>
        <div class="test-result__members py-3 print">
            <div class="mb-2"><b>Члены комиссии:</b></div>
            <table>
                <tbody>
                    <tr class="test-result__members_item align-top" v-for="member in members" :key="member.id"> 
                        <td class="py-2"><span v-if="member.position">{{ member.position }}, </span><span>{{ member.name }}</span></td>
                        <td class="py-2"><div class="ms-3">_______________________</div><div class="text-center ms-3" style="font-size:12px; line-height:0.5">(подпись)</div></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button class="btn btn-primary btn-print noprint" @click.prevent="print"><i class="fas fa-print"></i> Печать</button>
    </div>
</template>

<script>
export default {
    name: "TestResult",
    props: ['resultRight', 'resultTotal', 'resultData', 'testboxId', 'student', 'studentPos'],
    data: () => ({
        successful: false,
        count_mistake: 1,
        members: [],
        date: ""
    }),
    mounted() {
        this.getResultGrade(this.resultRight, this.resultTotal);
        this.loadMembers();
        this.date = this.currentDate();
    },
    methods: {
        getResultGrade(count, total){
            var mistakes = total - count;
            if(mistakes > this.count_mistake){
                this.successful = false;
            }else{
                this.successful = true;
            }
        },
        loadMembers() {
            axios.get('/api/members')
            .then(res => {
                this.members = res.data;
            })
        },
        print(){
            window.onafterprint = window.close;
            window.print();
        },
        currentDate(){
            return new Date().toLocaleDateString();
        }
    }
}
</script>
