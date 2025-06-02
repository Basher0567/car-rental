<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-10 center-screen">
                <div class="card animated fadeIn w-100 p-3">
                   <form @submit.prevent="submit">
                         <div class="card-body">
                        <h4>Sign Up</h4>
                        <hr/>
                        <div class="container-fluid m-0 p-0">
                            <div class="row m-0 p-0">
                                <div class="col-md-4 p-2">
                                    <label>Name</label>
                                    <input id="name" v-model="form.name" placeholder="Name" class="form-control" type="text"/>
                                </div>
                                <div class="col-md-4 p-2">
                                    <label>Email</label>
                                    <input id="email" v-model="form.email" placeholder="Email" class="form-control" type="email"/>
                                </div>
                                <div class="col-md-4 p-2">
                                    <label>Password</label>
                                    <input id="password" v-model="form.password" placeholder="User Password" class="form-control" type="password"/>
                                </div>
                                 <div class="col-md-4 p-2">
                                    <label>Role</label>
                                    <select v-model="form.role" class="form-select">
                                        <option value="admin">Admin</option>
                                        <option value="customer">Customer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row m-0 p-0">
                                <div class="col-md-4 p-2">
                                    <button type="submit"  class="btn mt-3 w-100  btn-success">Complete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
    import { Link,useForm,usePage,router } from '@inertiajs/vue3';
    const form=useForm({name:'',email:'',password:'',role:''})
    const page=usePage()

    function submit(){
        if(form.name.length===0){
            alert("Name Required")
        }
        else if(form.email.length===0){
            alert("Email Required")
        }
        else if(form.password.length===0){
            alert("Password Required")
        }
        else if(form.role.length===0){
            alert("Role Required")
        }
        else{
            form.post("/user-registration",{
            onSuccess:()=>{
                if(page.props.flash.status===true){
                    router.get(`LoginPage`)
                }else{
                    alert(page.props.flash.message)
                }
            }
        })
        }
    }
</script>
