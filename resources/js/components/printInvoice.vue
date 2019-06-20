<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3 style="text-align: center;">SONSY TRADING</h3>
                    <h5 style="text-align: center;">Invoice No:{{InvoiceNo.InvoiceNo}}</h5>
                    <h6 style="text-align: center;">Date:{{InvoiceNo.created_at}}</h6><br><br>
                    <form @submit.prevent="Generate">
                        <input type="hidden" v-model="InvoiceNo.CustomerID" class="form-control">
                        <h6><strong>Customer:</strong></h6>
                        <p>{{customerDetails.Fname}} {{customerDetails.Lname}}<br>
                        {{customerDetails.City}}<br>
                        {{customerDetails.Street}}<br>
                        Tel:{{customerDetails.No}}</p>
                        <div class="row ">
                                <table class="table table-bordered" id="protable">
                                    <thead>
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
                        <div class="form-group">
                            <button class="btn btn-primary" id="saveInvoice" @click="Generate()">Generate Invoice</button>
                            <button class="btn btn-primary" id="sa" @click="printInvoice()">Print</button>
                        </div>
                        <div class="form-group">
                            
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
                InvoiceNo:{},
                customerDetails:{},
                getItems:{},
                form:new Form({
                }),
            }      
        },
        methods:{
            invoiceLastId(){
                axios.get("api/invoiceget").then(({data}) => (this.InvoiceNo = data));
            },
            customerInfo(){
                axios.get("api/customerID/"+this.InvoiceNo.CustomerID).then(({data}) => (this.customerDetails = data));
            },
            getItem(){
                axios.get("api/getItems/"+this.InvoiceNo.InvoiceNo).then(({data}) => (this.getItems = data));
            },
            Generate(){
                this.customerInfo();
                this.getItem();
            },
            printInvoice(){
                window.print();
            }
        },
        created() {
            this.invoiceLastId();
        }
    }
</script>
<style>
    @media print{
        #saveInvoice ,#sa{
            opacity:0;
        }
    }
</style>

