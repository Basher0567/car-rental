<template>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form @submit.prevent="submit">
                        <div class="card-body">
                            <h4>Add New Car</h4>
                            <br/>
                            <input id="name" v-model="form.name" placeholder="Car Name" class="form-control" type="text"/>
                            <br/>
                            <input id="brand" v-model="form.brand" placeholder="Brand" class="form-control" type="text"/>
                            <br/>
                            <input id="model" v-model="form.model" placeholder="Model" class="form-control" type="text"/>
                            <br/>
                            <input id="year" v-model="form.year" placeholder="Year" class="form-control" type="text"/>
                            <br/>
                            <input id="car-type" v-model="form.car_type" placeholder="Car Type" class="form-control" type="text"/>
                            <br/>
                            <input id="daily_rent_price" v-model="form.daily_rent_price" placeholder="Daily Rent Price" class="form-control" type="text"/>
                            <br/>
                           <div>
                            <label for="availability">Availability</label>
                            <select v-model="form.availability" class="form-select" aria-label="Default select example">
                                <option selected>select menu</option>
                                <option value="available">Available</option>
                                <option value="not_available">Not Available</option>
                            </select>
                           </div>
                           
                            <br/>
                                <div>
                                    <label for="image">Car Image:</label> <br>
                                    <!-- <input type="file" id="image" @change="handleFileUpload" /> -->
                                    <ImageUpload :productImage="form.image" @image="(e)=>form.image = e"/>
                                </div>

                            <button type="submit" class="btn w-100 btn-success">Save</button>
                            <hr/>

                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
    import { ref } from 'vue';
    import { useForm,usePage,router } from '@inertiajs/vue3';
    import { createToaster } from "@meforma/vue-toaster";
    import ImageUpload from './ImageUpload.vue';

    const toaster = createToaster();
    const id=new URLSearchParams(window.location.search).get("id")
    const form=useForm({name:'',brand:'',model:'',year:'',car_type:'',daily_rent_price:'',availability:'',image:null,id:id})
    const page=usePage()


    //const id=ref(parseInt(urlParam.get("id")))


    let URL="/create-car"
    let list=page.props.list

    if(id!==0 && list !==null){
        URL="/update-car"
        form.name=list.name
        form.brand=list.brand
        form.model=list.model
        form.year=list.year
        form.car_type=list.car_type
        form.daily_rent_price=list.daily_rent_price
        form.availability=list.availability
        form.image=list.image
    }


    function submit(){
        if(form.name.length===0){
        toaster.warning("Car Name Required")
        }
        else if(form.brand.length===0){
        toaster.warning("Brand Required")
        }
        else if(form.model.length===0){
        toaster.warning("Car Model Required")
        }
        else if(form.year.length===0){
        toaster.warning("Year Required")
        }
        else if(form.car_type.length===0){
        toaster.warning("Car Type Required")
        }
        else if(form.daily_rent_price.length===0){
        toaster.warning("Daily Rent Price Required")
        }
        else if(form.availability.length===0){
        toaster.warning("Availability Required")
        }
        else if(form.image.length===0){
        toaster.warning("Image Required")
        }
        else{
            form.post(URL,{
            onSuccess:()=>{
                if(page.props.flash.status===true){
                    router.get("/CarPage")
                    toaster.success(page.props.flash.message)
                }
                else{
                    toaster.warning(page.props.flash.error)
                }
            }
        })
        }
     }
</script>
