<template>
    <div class="container">
        <div class="card" v-if="$gate.isAdminOrKeeper()">
            <div class="card-header">
               <center><b>Add Stock Items</b></center>
            </div>
            <!-- <form @submit.prevent="AddItem" id="addForm">
                /*<div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Item Name</label>
                        <input v-model="form.ItemName" type="text" name="ItemName"
                            placeholder="Enter Item Name"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('ItemName') }">
                        <has-error :form="form" field="ItemName"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Quantity</label>
                        <input v-model="form.Quantity" type="number" name="Quantity"
                            placeholder="Enter Quantity"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('Quantity') }">
                        <has-error :form="form" field="Quantity"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                        <label>UnitPrice</label>
                        <input v-model="form.UnitPrice" type="number" name="UnitPrice"
                            placeholder="Enter UnitPrice"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('UnitPrice') }">
                        <has-error :form="form" field="UnitPrice"></has-error>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Discount</label>
                        <input v-model="form.Discount" type="number" name="Discount"
                            placeholder="Enter Discount"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('Discount') }">
                        <has-error :form="form" field="Discount"></has-error>
                    </div>
                    <div class="form-group col-md-3">
                        <label>SupplierId</label>
                        <input v-model="form.SupplierId" type="text" name="SupplierId"
                            placeholder="Enter SupplierId"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('SupplierId') }">
                        <has-error :form="form" field="SupplierId"></has-error>
                    </div>
                    <div class="form-group col-md-6">
                        <label>InvoiceNo</label>
                        <input v-model="form.InvoiceNo" type="text" name="InvoiceNo"
                            placeholder="Enter InvoiceNo"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('InvoiceNo') }">
                        <has-error :form="form" field="InvoiceNo"></has-error>
                    </div>
                    <div class="form-group col-md-6">
                        <label>SellingPrice</label>
                        <input v-model="form.SellingPrice" type="number" name="SellingPrice"
                            placeholder="Enter SellingPrice"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('SellingPrice') }">
                        <has-error :form="form" field="SellingPrice"></has-error>
                    </div>
                    <div class="form-group col-md-6">
                        <label>TotalBalance</label>
                        <input v-model="form.TotalBalance" type="number" name="TotalBalance"
                            placeholder="Enter TotalBalance"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('TotalBalance') }">
                        <has-error :form="form" field="TotalBalance"></has-error>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Item Availability</label>
                        <input v-model="form.Active" type="text" name="Active"
                            placeholder="Enter Active"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('Active') }">
                        <has-error :form="form" field="Active"></has-error>
                    </div>
                    <button type="submit" class="btn btn-primary" id="addbtn">Add Item</button>
                </div>
            </form>-->
            <form @submit.prevent="AddItem2">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Item Name</label>
                        <input v-model="form.ItemName" type="text" name="ItemName"
                            placeholder="Enter Item Name"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('ItemName') }">
                        <has-error :form="form" field="ItemName"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Quantity</label>
                        <input v-model="form.Quantity" type="number" name="Quantity"
                            placeholder="Enter Quantity"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('Quantity') }">
                        <has-error :form="form" field="Quantity"></has-error>
                    </div>
                    <div class="form-group col-md-4">
                        <label>UnitPrice</label>
                        <input v-model="form.UnitPrice" type="number" name="UnitPrice"
                            placeholder="Enter UnitPrice"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('UnitPrice') }">
                        <has-error :form="form" field="UnitPrice"></has-error>
                    </div>
                    <div class="form-group col-md-4 mt-3">
                        <label>SupplierId</label>
                        <input v-model="form.SupplierId" type="text" name="SupplierId"
                            placeholder="Enter SupplierId"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('SupplierId') }">
                        <has-error :form="form" field="SupplierId"></has-error>
                    </div>
                    <div class="form-group col-md-4 mt-3">
                        <label>InvoiceNo</label>
                        <input v-model="form.InvoiceNo" type="text" name="InvoiceNo"
                            placeholder="Enter InvoiceNo"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('InvoiceNo') }">
                        <has-error :form="form" field="InvoiceNo"></has-error>
                    </div>
                    <div class="form-group col-md-4 mt-3">
                        <label>SellingPrice</label>
                        <input v-model="form.SellingPrice" type="number" name="SellingPrice"
                            placeholder="Enter SellingPrice"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('SellingPrice') }">
                        <has-error :form="form" field="SellingPrice"></has-error>
                    </div>
                <button type="submit" class="btn btn-primary" id="addbtn">Add Item</button>
                </div>
            </form>
        </div>
        <div v-if="!$gate.isAdminOrKeeper()">
          <not-found></not-found>
      </div>
    </div>    
</template>

<script>
    export default {
        data(){
            return{
                form: new Form({
                    Discount:'',
                    ItemName:'',
                    UnitPrice:'',
                    SupplierId:'',
                    InvoiceNo:'',
                    Quantity:'',
                    SellingPrice:'',
                    TotalBalance:'',
                })
            }
        },
        methods: {
            AddItem(){
                this.$Progress.start();
                this.form.post('api/stocks')
                .then(()=>{
                    Toast.fire({
                    type: 'success',
                    title: 'Item added successfully'
                    })
                this.$Progress.finish();
                })
                .catch(()=>{
                    
                })
            },
            AddItem2(){
                this.form.post('api/stocks')
                .then(()=>{
                    this.form.reset();
                    Toast.fire({
                    type: 'success',
                    title: 'Item added successfully'
                    })
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style>
    #addForm {
        padding: 15px;
    }
    #addbtn{
        margin-left: 5px;
        width:99.2%;
        height:50px;
    }
</style>