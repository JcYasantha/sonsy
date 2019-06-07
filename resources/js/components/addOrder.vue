<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><b>Add Order</b></div>
                    <div class="card-body">
                        <form @submit.prevent="saveInvoice">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6"> 
                                     <div class="form-group" >
                                        <label for="customer">Select the Customer</label>
                                        <select id="customername" class="form-control customername" name="CustomerID" v-model="form.CustomerID" required>
                                                    <option value="0" selected="true" disabled="true" >select the customer</option>
                                                         <option v-for="customer in customers" :key="customer.CustomerID" v-bind:value="customer.CustomerID">{{customer.Fname}}</option>       
                                                </select>
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
                                <table class="table table-bordered" id="protable">
                                    <thead>
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>Total</th>
                                        <th style="text-align:center;"><a href="#" class="addrow" @click="addNewRow"><i class="material-icons icon">add_box</i></a></th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(invoice_product, k) in invoice_products" :key="k">
                                            <td>
                                                <select v-model="invoice_product.itemname" class="form-control itemname" @change="calculateLineTotal(invoice_product)">
                                                    <option value="0" selected="true" disabled="true">select</option>
                                                         <option v-for="stock in stocks" :key="stock.ItemNo" :value="{ id: stock.id, SellingPrice: stock.SellingPrice }" name="itemname[]">{{stock.ItemName}}</option>       
                                                </select>
                                                
                                            </td>
                                            <td><input type="number" min="0" max="invoice_product.itemname.Quantity" step="1" v-model="invoice_product.quantity" value="{invoice_product.itemname.qty}" class="form-control qty" @change="calculateLineTotal(invoice_product)"></td>
                                            <td><input readonly type="number" min="0" step="1" v-model="invoice_product.itemname.SellingPrice" class="form-control amount" @change="calculateLineTotal(invoice_product)"></td>
                                            <td><input readonly class="form-control total" type="number" min="0" step=".01" v-model="invoice_product.line_total" /></td>
                                            <td style="text-align:center;"><a href="#" class="remove" style="color:red;" @click="deleteRow(k, invoice_product)"><i class="material-icons icon">delete</i></a></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td style="border:none"></td>
                                            <td style="border:none"></td>
                                            <td style="border:none">Total<b style="float:right">(Rs)</b></td>
                                            <td><b class="total">{{form.Outstanding}}</b></td>
                                            <td style="border:none"></td>
                                        </tr>
                                    </tfoot>                                   
                                </table>
                                <button class="btn btn-success" id="saveInvoice" style="float:right;">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                stocks : {},
                customers:{},
                InvoiceNo:{},
                invoice_products: [{
                    itemname: '',
                    quantity: '',
                    amount: '',
                    line_total:0,
                }],
            form:{
                CustomerID:0,
                Outstanding: 0,
                }
            }
        },
        methods:{
            loadStock(){
                axios.get("api/stock").then(({data}) => (this.stocks = data));
            },
            loadCustomer(){
                axios.get("api/customer").then(({data}) => (this.customers = data));
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
                    this.invoice_products.splice(idx, 1);
                }
                this.calculateTotal();
            },
            calculateLineTotal(invoice_product) {
                var total = parseFloat(invoice_product.quantity) * parseFloat(invoice_product.itemname.SellingPrice);
                if (!isNaN(total)) {
                    invoice_product.line_total = total.toFixed(2);
                }
                this.calculateTotal();
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
                
                axios.post('api/invoice', {dataD, formD})
                .then( res => {
                    console.log(res)
                })
                .catch( e => {
                    console.log(e)
                })
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
            printme(){
                window.print();
            }
        },
        created() { 
            this.loadStock();
            this.loadCustomer();
            //this.invoiceLastId();
        }
    }
</script>
<style>
    #del{
        color: crimson;
    }
    #btn-add{
        float: right;
    }
</style>
