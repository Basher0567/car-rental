<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                       <div class="float-end">
                            <Link :href="`/RentalSavePage?id=0`" class="btn btn-success mx-3 btn-sm">
                                Create Rental
                            </Link>
                        </div>
                        <div>
                            <input type="text" placeholder="Search ..." class="form-control mb-2 w-auto form-control-sm" v-model="searchValue">
                            <EasyDataTable
                                buttons-pagination alternating
                                :headers="Header"
                                :items="Item"
                                :search-field="searchField"
                                :search-value="searchValue"
                                show-index>
                                <template #item-number="{ id,name }">
                                    <Link class="btn btn-success btn-sm" :href="`/RentalSavePage?id=${id}`">Edit</Link>
                                    <button class="btn btn-success mx-3 btn-sm" @click="itemClick(number,player)">Show</button>
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
    import { usePage,Link,router} from '@inertiajs/vue3';
    import { createToaster } from "@meforma/vue-toaster";

    const toaster = createToaster();
    const page=usePage()
//console.log(page.props.list)
    const Header=[
        {text:"CustomerName",value:"name"},
        {text:"CarDetails",value:"car.name"},
        {text:"StartDate",value:"start_date"},
        {text:"EndDate",value:"end_date"},
        {text:"Total Cost",value:"total_cost"},
        {text:"Status",value:"status"},
        {text:"Action", value:"number"}
    ]
    const searchValue = ref();

    const Item=ref(page.props.list)

     const deleteClick=(id)=>{
        //alert(id)
        let text="Do you want to Delete?"
        if(confirm(text)===true){
            router.get(`/delete-rental/${id}`)
            toaster.success("Delete Successful")
        }
        else{
            text="You canceled"
        }

    }

    const itemClick = (number,player) => {
        alert(`Number is=${number} & Player Name is=${player}`)
    }
</script>
