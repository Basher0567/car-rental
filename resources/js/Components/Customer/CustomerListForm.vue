<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end">
                            <Link href="/CustomerSavePage?id=0" class="btn btn-success mx-3 btn-sm">
                                Add New Customer
                            </Link>
                        </div>
                        <div>
                            <input type="text" placeholder="Search ..." class="form-control mb-2 w-auto form-control-sm" v-model="searchValue">
                            <EasyDataTable
                                buttons-pagination alternating
                                :headers="Header"
                                :items="Item"
                                :row-per-page="10"
                                :search-field="searchField"
                                :search-value="searchValue"
                                show-index>
                                <template  #item-number="{id}">
                                    <Link class="btn btn-success btn-sm" :href="`/CustomerSavePage?id=${id}`">Edit</Link>
                                    <Link class="btn btn-success mx-3 btn-sm" :href="`/show-customer?id=${id}`">Show</Link>
                                    <button class="btn btn-danger btn-sm" @click="deleteClick(id)">Delete</button>
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
    import {router,usePage,Link } from '@inertiajs/vue3';
    import { createToaster } from "@meforma/vue-toaster";

    const toaster = createToaster();
    const page=usePage()

    const Header=[
        {text:"Name",value:"name"},
        {text:"Email",value:"email"},
        {text:"Phone",value:"phone"},
        {text:"Address",value:"address"},
        {text:"Action",value:"number"}
    ];

    const searchValue = ref();
    const Item=ref(page.props.list)

   const deleteClick = (id) => {
    if (confirm("Do you want to delete?")) {
        router.get(`/delete-customer/${id}`);
        toaster.success("Delete Successful");
    } else {
        toaster.info("You canceled");
    }
    };
    const itemClick=(number,player)=>{
        alert(`Number is=${number} && Player is=${player}`)
    }

</script>
