<template>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <form @submit.prevent="submit">
                        <div class="card-body">
                        <h4>Create Rental</h4>
                            <br/>
                            <!-- User Dropdown -->
                            <div>
                                <label for="user">Select User:</label>
                                <select v-model="form.user_id" class="form-control" id="user">
                                    <option value="" disabled>Select a User</option>
                                    <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
                                </select>
                            </div>
                            <br/>
                            <!-- car Dropdown -->
                            <div>
                                <label for="car">Select Car:</label>
                                <select v-model="form.car_id" class="form-control" id="car">
                                    <option value="" disabled>Select a Car</option>
                                    <option v-for="car in cars" :key="car.id" :value="car.id">{{ car.name }}</option>
                                </select>
                            </div>
                            <br/>
                            <input id="start_date" v-model="form.start_date" placeholder="Start_date" class="form-control" type="date"/>
                            <br/>
                            <input id="end_date" v-model="form.end_date" placeholder="End_date" class="form-control" type="date"/>
                            <br/>
                            <input id="total_cost" v-model="form.total_cost" placeholder="total_cost" class="form-control" type="text"/>
                            <br/>
                            <div>
                                <label for="status">Status</label>
                                <select v-model="form.status" class="form-select" id="status">
                                    <option selected>Select an option</option>
                                    <option value="pending">Pending</option>
                                    <option value="ongoing">Ongoing</option>
                                    <option value="complete">Completed</option>
                                    <option value="canceled">Canceled</option>
                                </select>
                            </div>
                            <br/>
                            <button type="submit" class="btn w-100 btn-success">Save</button>
                            <hr/>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
    import { ref,reactive } from 'vue';
    import { useForm,usePage,Link,router } from '@inertiajs/vue3';
    import { createToaster } from "@meforma/vue-toaster";
    const toaster = createToaster();

    const urlParam=new URLSearchParams(window.location.search);
    const id=ref(parseInt(urlParam.get("id")))

    const form=useForm({user_id:'',car_id:'',start_date:'',end_date:'',total_cost:'',status:'',id:id})
    const page=usePage()

    const users = ref(page.props.users)
    const cars = ref(page.props.cars)

    const errors = reactive({
        date: '',
    })

    const validateDates = () => {
        errors.date = ''
        if (new Date(form.end_date) < new Date(form.start_date)) {
            errors.date = 'End date cannot be earlier than start date.'
            toaster.warning(errors.date)
            return false
        }
        return true
    }


    let URL="/create-rental"
    let list=page.props.list

    if (id.value !== 0 && list !== null) {
    URL = "/update-rental";
    form.user_id = list['user_id'];
    form.car_id = list['car_id'];
    form.start_date = list['start_date'];
    form.end_date = list['end_date'];
    form.total_cost = list['total_cost'];
    form.status=list['status'];
    }

    function submit(){
        if(form.user_id.length===0){
            toaster.warning("User Required")
        }
        else if(form.car_id.length===0){
            toaster.warning("Car Required")
        }
        else if(form.start_date.length===0){
            toaster.warning("Start_date Required")
        }
        else if(form.end_date.length===0){
            toaster.warning("End_date Required")
        }
        else if(form.total_cost.length===0){
            toaster.warning("Total Cost Required")
        }
        else if(form.status.length===0){
            toaster.warning("Status Required")
        }
        else{
            if (validateDates()) {
                form.post(URL,{
            onSuccess:()=>{
                if(page.props.flash.status===true){
                    router.get("/RentalPage")
                    toaster.success(page.props.flash.message)
                }
                else{
                    toaster.warning(page.props.flash.error)
                }
            }
        })
            }
        }

    }
</script>



