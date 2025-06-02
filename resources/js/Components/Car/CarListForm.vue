<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end">
                            <Link :href="`/CarSavePage?id=${0}`" class="btn btn-success mx-3 btn-sm">
                                Add Car
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
                                <template #item-image="{ image }" class="pt-2 pb-2">
                                    <img :src="image" :alt="image" alt="" height="auto" width="40px">
                                </template>
                                 <template #item-number="{ id}">
                                    <Link class="btn btn-success mx-2 btn-sm" :href="`/CarSavePage?id=${id}`">Edit</Link>
                                    <Link class="btn btn-success mx-2 btn-sm" :href="`/show-car?id=${id}`">Show</Link>
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
    import { router, usePage,Link } from '@inertiajs/vue3';
    import { createToaster } from "@meforma/vue-toaster";

    const toaster = createToaster();
    const page=usePage()

    const Header = [
        { text: "Name", value: "name"},
        { text: "Brand", value: "brand"},
        { text: "Model", value: "model"},
        { text: "Year", value: "year"},
        { text: "Car_Type", value: "car_type"},
        { text: "Daily_Rent_price", value: "daily_rent_price"},
        { text: "Availability", value: "availability"},
        { text: "Image", value: "image"},
        { text: "Action", value: "number"},
    ];

    const searchValue = ref();

    const Item = ref(page.props.list)

    const deleteClick=(id)=>{
        //alert(id)
        let text="Do you want to Delete?"
        if(confirm(text)===true){
            router.get(`/delete-car/${id}`)
            toaster.success("Delete Successful")
        }
        else{
            text="You canceled"
        }

    }

</script>
