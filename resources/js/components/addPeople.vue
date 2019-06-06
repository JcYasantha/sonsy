<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
               <b>Add People</b>
               <button type="button" class="btn btn-warning" onclick="document.getElementById('customer').style.display='inline';document.getElementById('supplier').style.display='none'">Add Customers</button>
               <button type="button" class="btn btn-danger" onclick="document.getElementById('customer').style.display='none';document.getElementById('supplier').style.display='inline'">Add Suppliers</button>
            </div>
            <form id="customer" @submit.prevent="AddCustomer">
                <h1>Register Customers</h1>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>First Name</label>
                        <input v-model="form.Fname" type="text" name="Fname"
                            placeholder="Enter First Name"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('Fname') }">
                        <has-error :form="form" field="Fname"></has-error>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Last Name</label>
                        <input v-model="form.Lname" type="text" name="Lname"
                            placeholder="Enter Last Name"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('Lname') }">
                        <has-error :form="form" field="Lname"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Telephone No</label>
                        <input v-model="form.No" type="text" name="No"
                            placeholder="Enter Telephone Number"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('No') }">
                        <has-error :form="form" field="No"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                        <label>City</label>
                        <input v-model="form.City" type="text" name="City"
                            placeholder="Enter City"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('City') }">
                        <has-error :form="form" field="City"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Street</label>
                        <input v-model="form.Street" type="text" name="Street"
                            placeholder="Enter Street"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('Street') }">
                        <has-error :form="form" field="Street"></has-error>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Nic No</label>
                        <input v-model="form.NicNo" type="text" name="NicNo"
                            placeholder="Enter Nic No"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('NicNo') }">
                        <has-error :form="form" field="NicNo"></has-error>
                    </div>
                    <button type="submit" class="btn btn-warning" id="addbtn1">Register</button>
                </div>
            </form>
            <form id="supplier" style="display:none;" @submit.prevent="AddSupplier">
                <h1>Register Suppliers</h1>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Name</label>
                        <input v-model="form2.Name" type="text" name="Name"
                            placeholder="Enter Name"
                            class="form-control" :class="{ 'is-invalid': form2.errors.has('Name') }">
                        <has-error :form="form2" field="Name"></has-error>
                    </div>
                    <div class="form-group col-md-6">
                        <label>PhoneNO</label>
                        <input v-model="form2.PhoneNO" type="text" name="PhoneNO"
                            placeholder="Enter PhoneNO"
                            class="form-control" :class="{ 'is-invalid': form2.errors.has('PhoneNO') }">
                        <has-error :form="form2" field="PhoneNO"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                        <label>No</label>
                        <input v-model="form2.No" type="text" name="No"
                            placeholder="Enter Street No"
                            class="form-control" :class="{ 'is-invalid': form2.errors.has('No') }">
                        <has-error :form="form2" field="No"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Street</label>
                        <input v-model="form2.Street" type="text" name="Street"
                            placeholder="Enter Street"
                            class="form-control" :class="{ 'is-invalid': form2.errors.has('Street') }">
                        <has-error :form="form2" field="Street"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                        <label>City</label>
                        <input v-model="form2.City" type="text" name="City"
                            placeholder="Enter City"
                            class="form-control" :class="{ 'is-invalid': form2.errors.has('City') }">
                        <has-error :form="form2" field="City"></has-error>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Email</label>
                        <input v-model="form2.Email" type="email" name="Email"
                            placeholder="Enter Email"
                            class="form-control" :class="{ 'is-invalid': form2.errors.has('Email') }">
                        <has-error :form="form2" field="Email"></has-error>
                    </div>
                    <button type="submit" class="btn btn-danger" id="addbtn2">Register</button>
                </div>
            </form>
        </div> 
    </div>   
</template>
<script>
export default {
    data(){
        return{
            form: new Form({
                //CustomerID : '',
                Fname: '',
                Lname: '',
                No: '',
                City: '',
                Street: '',
                NicNo:''
            }),
            form2: new Form({
                Name:'',
                PhoneNO:'',
                Email:'',
                No:'',
                Street:'',
                City:''
            })
        }
    },
    methods:{
        AddCustomer(){
            this.form.post('api/customer');
        },
        AddSupplier(){
            this.form2.post('api/supplier');
        }
    }
}
</script>
<style>
    #customer{
        padding: 15px;
    }
    #supplier{
        padding: 15px;
    }
</style>
