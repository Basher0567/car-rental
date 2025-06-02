<template>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <form @submit.prevent="submit">
                        <div class="card-body">
                        <h4>Add New Customer</h4>
                            <br/>
                            <input id="name" v-model="form.name" placeholder="Customer Name" class="form-control" type="text"/>
                            <br/>
                            <input id="email" v-model="form.email" placeholder="Email" class="form-control" type="email"/>
                            <br/>
                            <input id="phone" v-model="form.phone" placeholder="Phone" class="form-control" type="text"/>
                            <br/>
                            <input id="address" v-model="form.address" placeholder="Address" class="form-control" type="text"/>
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
    import { ref } from 'vue';
    import { router, useForm,usePage } from '@inertiajs/vue3';
    import { createToaster } from "@meforma/vue-toaster";

    const toaster = createToaster();

    const urlParam=new URLSearchParams(window.location.search);
    const id=ref(parseInt(urlParam.get("id")))

    const form=useForm({name:'',email:'',phone:'',address:'',id:id})
    const page=usePage()

    let URL="/create-customer"
    let list=page.props.list

    if(id.value!==0 && list !==null){
        URL="/update-customer"
        form.name=list.name
        form.email=list.email
        form.phone=list.phone
        form.address=list.address
    }

    function submit(){
        if(form.name.length===0){
            toaster.warning("Customer Name Required")
        }
        else if(form.email.length===0){
            toaster.warning("Customer Email Required")
        }
        else if(form.phone.length===0){
            toaster.warning("Phone Required")
        }
        else if(form.address.length===0){
            toaster.warning("Address Required")
        }
        else{
            form.post(URL,{
                onSuccess:()=>{
                    if(page.props.flash.status===true){
                        router.get("/CustomerPage")
                        toaster.success(page.props.flash.message)
                    }else{
                        toaster.success(page.props.flash.message)
                    }

                }
            })
        }
    }
</script>
