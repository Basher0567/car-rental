<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <EasyDataTable
                                buttons-pagination alternating
                                :headers="Header"
                                :items="Item"
                                :search-field="searchField"
                                :search-value="searchValue"
                                show-index>
                                <template #item-number="{ id,name }">
                                    <button class="btn btn-danger mx-3 btn-sm" @click="itemClick(number,player)">Cancel</button>
                                </template>
                            </EasyDataTable>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
    import { ref } from 'vue';
    import { usePage,Link } from '@inertiajs/vue3';

    const page=usePage()

    const Header=[
        {text:"CarName",value:"car.name"},
        {text:"CarBrand",value:"car.brand"},
        {text:"StartDate",value:"start_date"},
        {text:"EndDate",value:"end_date"},
        {text:"Total Cost",value:"total_cost"},
        {text:"Status",value:"status"},
        {text:"Action", value:"number"}
    ]

    const Item=ref(page.props.list)

</script>
