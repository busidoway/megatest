<template>
    <div class="page-result">
        <div class="test-result__members">
            <div class="mb-2"><b>Члены комиссии:</b></div>
            <div class="mb-2 test-result__members_item" v-for="member in members" :key="member.id">
                <span>{{ member.name }}</span><span v-if="member.position">, {{ member.position }}</span>
            </div>
        </div>
        <button class="btn btn-primary" @click.prevent="print">Печатать</button>
    </div>
</template>

<script>
export default {
    data: () => ({
        data: [],
        members: this.$route.params.data
    }),
    mounted() {

    },
    methods: {
        print(){
            window.onafterprint = window.close;
            window.print();
        }
    }
}
</script>