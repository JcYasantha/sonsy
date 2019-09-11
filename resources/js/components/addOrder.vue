<template>
    <div class="container" >
        <div v-if="!$gate.isAdmin()">
                    <not-found></not-found>
                </div>
        <div class="row justify-content-center" v-if="$gate.isAdmin()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><b>Add Order</b></div>
                    <div class="card-body">
                        <form @submit.prevent>
                            <div class="row">
                                <div class="col-lg-6 col-sm-6"> 
                                     <div class="form-group" >
                                        <select2 name="model1[]" v-model="form.id" style="min-width:100%" @input="onChange()">
                                            <option value="0" disabled >Select a Customer</option>
                                            <option v-for="customer in customers" :key="customer.id" v-bind:value="customer.id">{{customer.Fname}} {{customer.Lname}} | {{customer.City}},{{customer.Street}}</option> 
                                        </select2>
                                        
                                    </div>
                                    <br><br><br>
                                </div>
                                <!-- <div class="col-lg-6 col-sm-6"> 
                                     <div class="form-group" >
                                        <label>Last Invoice #0{{InvoiceNo.InvoiceNo}}</label>
                                         <input type="number" min="InvoiceNo.InvoiceNo+1" v-model="form.newInvoiceNo" class="form-control">
                                    </div>
                                    <br><br><br>
                                </div>-->
                            </div>
                            <div class="row">
                                <table class="table" id="protable">
                                    <thead class="thead-light">
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>Total</th>
                                        <th style="text-align:center;"></th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(invoice_product, k) in invoice_products" :key="k">
                                            <td>
                                                <select name="model2[]" v-model.number="invoice_product.itemname" class="form-control itemname" @input="calculateLineTotal(k,invoice_product)" required>
                                                        <option disabled selected value="0">Item</option>
                                                         <option v-for="stock in stocks" :key="stock.ItemNo" v-bind:value="{id:stock.ItemName, SellingPrice:stock.SellingPrice, Quantity:stock.Quantity, item:stock.ItemName}" name="itemname[]">{{stock.ItemName}}</option>       
                                                </select>
                                                
                                            </td>
                                            <td><input type="number" id="lkd" required min="0" max="invoice_product.itemname.Quantity" step="1" name="test" v-model="invoice_product.quantity" class="form-control qty" @input="calculateLineTotal(k,invoice_product)" @click="itemLow(k,invoice_product)"></td>
                                            <td><input readonly required type="number" min="0" step="1" v-model="invoice_product.itemname.SellingPrice" class="form-control amount" @input="calculateLineTotal(k,$event)"></td>
                                            <td><input readonly required class="form-control total" type="number" min="0" step=".01" v-model="invoice_product.line_total" /></td>
                                            <td style="text-align:center;"><a href="#" class="remove" style="color:red;" @click="deleteRow(k, invoice_product)"><i class="material-icons icon">delete</i></a></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td style="border:none"><a href="#" class="addrow" @click="addNewRow"><i class="material-icons icon">add_box</i></a></td>
                                            <td style="border:none"></td>
                                            <td style="border:none">Total<b style="float:right">(Rs)</b></td>
                                            <td><b class="total">{{form.Outstanding}}</b></td>
                                            <td style="border:none"></td>
                                        </tr>
                                        
                                    </tfoot>                                   
                                </table>
                                <div class="form-group">
                                    <button class="btn btn-success" v-show="editMode" @click="saveInvoice()" id="saveInvoice" data-toggle="modal" v-if="seen">View Invoice</button>
                                    <button class="btn btn-success" v-show="!editMode" @click="editInvoice()" id="saveInvoice" data-toggle="modal">Edit Invoice</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <notifications group="foo" />
                <!-- //////////////////////////////////////////////////////////// -->
                                <!-- modal to view the invoice -->
                <!-- //////////////////////////////////////////////////////////// -->

                <div class="modal fade" id="viewInvoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Invoice</h5>
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                        </button> -->
                    </div>
                    <div class="modal-body">
                        <div class="card" id="printMe">
                    <div class="card-body">
                        <h3 style="text-align: center;">SONSY TRADING</h3>
                    <h5 style="text-align: center;">Invoice No:{{InvoiceNo.id}}</h5>
                    <h6 style="text-align: center;">Date:{{InvoiceNo.created_at}}</h6><br><br>
                        <input type="hidden" v-model="InvoiceNo.CustomerID" class="form-control">
                        <h6><strong>Customer:</strong></h6>
                        <p>{{customerDetails.Fname}} {{customerDetails.Lname}}<br>
                        {{customerDetails.City}}<br>
                        {{customerDetails.Street}}<br>
                        Tel:{{customerDetails.No}}</p>
                        <div class="row ">
                                <table class="table" id="protable">
                                    <thead class="thead-light">
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in getItems" :key="item.ID">
                                            <td>{{item.Items}}</td>
                                            <td>{{item.Quantity}}</td>
                                            <td>{{item.Amount}}</td>
                                        </tr>
                                    </tbody> 
                                    <tfoot>
                                        <tr>
                                            <td style="border:none"></td>
                                            <td style="border:none">Total<b style="float:right">(Rs)</b></td>
                                            <td><b class="total">{{InvoiceNo.Outstanding}}</b></td>
                                        </tr>
                                    </tfoot>                                  
                                </table>
                        </div>
                    </div>
                </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal"  @click="editmode()">Edit Invoice</button>
                        <button type="button" class="btn btn-primary" style="float:right;" @click="printme()">Print</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" @click="cancelOrder()">Cancel Order</button>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
    
    import Select2 from './Select2.vue';
    // window.addEventListener("beforeunload", function(event) {
    //     event.returnValue = "Ydsaudnusajdu";
    // });
    // $(document).ready(function(){
    //     $('#saveInvoice').click(function(){
    //         $('#viewInvoice').modal({
    //             backdrop: 'static',
    //             keyboard: false
    //         });
    //     });
    // });
    export default {
        data(){
            return{
                editMode: true,
                seen:false,
                stocks : {},
                customers:{},
                InvoiceNo:{},
                customerDetails:{},
                getItems:{},
                invoice_products: [{
                    itemname: '',
                    quantity: '',
                    amount: '',
                    line_total:0,
                }],
                form:{
                    id:0,
                    Outstanding: 0,
                },
                output: null
            }  
        },
        
        methods:{
            onChange(){
                this.seen = true;
            },
            loadStock(){
                if(this.$gate.isAdmin()){
                    axios.get("api/stock").then(({data}) => (this.stocks = data));
                }
            },
            loadCustomer(){
                if(this.$gate.isAdmin()){
                    axios.get("api/customer").then(({data}) => (this.customers = data));    
                }
            },
            //invoiceLastId(){
            //    axios.get("api/invoiceget").then(({data}) => (this.InvoiceNo = data));
            //},
            addNewRow() {
            this.invoice_products.push({
                itemname: '',
                quantity: '',
                amount: '',
                line_total:0
            });
            },
            deleteRow(index, invoice_product) {
                var idx = this.invoice_products.indexOf(invoice_product);
                console.log(idx, index);
                if (idx > -1) {
                    if(idx==0){

                    }else{
                        this.invoice_products.splice(idx, 1);
                    }
                }
                this.calculateTotal();
            },
            calculateLineTotal(index,invoice_product) {
                //console.log(index)
                var idx = this.invoice_products.indexOf(invoice_product);
                var total = parseFloat(invoice_product.quantity) * parseFloat(invoice_product.itemname.SellingPrice);
                //console.log(total)
                if(invoice_product.itemname.Quantity < invoice_product.quantity){
                     Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Quantity exceed the stock of '+ invoice_product.itemname.item,
                        }).then((result) => {
                            //$("#lkd").val("");
                            this.invoice_products.splice(idx, 1);
                        })      
                }
                if (!isNaN(total)) {
                    invoice_product.line_total = total.toFixed(2);
                }
                this.calculateTotal();
            },
            itemLow(index,invoice_product){
                if(invoice_product.itemname.Quantity < 1000){
                    this.$notify({
                            group: 'foo',
                            type: 'error',
                            title: 'Important message',
                            text: invoice_product.itemname.item + ' is running low.Please take necessary actions.',
                            duration: 10000,
                    });  
                }
            },
            calculateTotal() {
                var subtotal;
                subtotal = this.invoice_products.reduce(function (sum, product) {
                    var lineTotal = parseFloat(product.line_total);
                    if (!isNaN(lineTotal)) {
                        return sum + lineTotal;
                    }
                }, 0);
                this.form.Outstanding = subtotal.toFixed(2);
            },
            saveInvoice(){
                console.log(JSON.stringify(this.invoice_products));
                let formD = {
                    cli: this.form
                }
                let dataD = {
                    inc: this.invoice_products
                }
                
                if(this.$gate.isAdmin()){
                    axios.post('api/invoice', {dataD, formD})
                    .then( res => {
                        //this.$router.push('printInvoice')
                        this.invoiceLastId();
                        //console.log(res)
                        this.customerInfo();
                        this.getItem(res.data);
                        $('#viewInvoice').modal('show');    
                    })
                    .catch( e => {
                        console.log(e)
                    })
                }
                
                /* this.form.post('api/invoice', data)
                    .then( res => {
                        //this.printme();
                        console.log(data)
                    })
                    .catch( e => {
                        this.$Progress.fail()
                        console.log(e)
                    })  */
                //this.form.post('api/invoice');
               // this.form.post('api/outstanding');
            },
            editInvoice(){
                console.log(JSON.stringify(this.invoice_products));
                let formD = {
                    cli: this.form
                }
                let dataD = {
                    inc: this.invoice_products
                }
                if(this.$gate.isAdmin()){
                    axios.put('api/invoice/' + this.InvoiceNo.id , {dataD, formD})
                    .then( res => {
                        this.invoiceLastId();
                        //console.log(res)
                        this.customerInfo();
                        console.log(res.data)
                        this.getItem(res.data);
                        $('#viewInvoice').modal('show');    
                    })
                    .catch( e => {
                        console.log(e)
                    })
                }
                
            },
            printme(){
                this.$htmlToPaper('printMe', () => {
                    location.reload(); 
                });
            },
            invoiceLastId(){
                if(this.$gate.isAdmin()){
                    axios.get("api/invoiceget").then(({data}) => (this.InvoiceNo = data));
                }
                
            },
            customerInfo(){
                if(this.$gate.isAdmin()){

                    axios.get("api/customerID/"+this.form.id).then(({data}) => (this.customerDetails = data));
                }
            },
            getItem(num){
                if(this.$gate.isAdmin()){

                    axios.get("api/getItems/"+num).then(({data}) => (this.getItems = data));
                }
            },
            cancelOrder(){
                console.log(JSON.stringify(this.invoice_products));
                let formD = {
                    cli: this.form
                }
                let dataD = {
                    inc: this.invoice_products
                }
                Swal.fire({
                title: 'Cancel the Order?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
                }).then((result) => {
                if (result.value) {
                    if(this.$gate.isAdmin()){
                        axios.put('api/cancelOrder/' + this.InvoiceNo.id , {dataD, formD})
                        .then( res => {
                            Swal.fire(
                            'Canceled!',
                            'Order has been canceled.',
                            'success'
                            ).then((result) => {
                                location.reload();
                            })
                        })
                        .catch( e => {
                            console.log(e)
                        })
                    }  
                }else{
                    $('#viewInvoice').modal('show')   
                }
                })
                
            },
            editmode(){
                this.editMode = false;
            }
        },
        created() { 
            this.loadStock();
            this.loadCustomer();
            this.editMode = true;
        },
        components:{
            'select2': Select2
        },
    }
</script>
<style>
    .modal-lg {
        max-width: 65%;
    }
    #del{
        color: crimson;
    }
    #btn-add{
        float: right;
    }
</style>
