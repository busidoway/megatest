<template>
    <div class="test-items py-2 mb-5">
        <div class="row m-0 py-2" v-for="item in items" :key="item.label">
            <span class="me-3" :if="item.label"># {{ item.label }}:</span><input type="text" name="item.label" class="form-control">
        </div>
        <div class="py-2">
            <button class="btn btn-sm btn-btn btn-outline-gray-500 d-inline-flex align-items-center" @click.prevent="addItem">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="icon icon-xs me-2"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Добавить пункт
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        data: () => ({
            items: [
                { label:1 }
            ],
            error: false,
            success: false
        }),
        methods: {
            addItem() {
                this.items.push({
                    label: this.items.length + 1
                })
            }
        }
    }
</script>