<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Invoices to be Issued</div>

                    <div class="card-body">
                        <table class="table table-hover">
                            <tbody><tr>
                            <th>Invoice ID</th>
                            <th>Outstanding (Rs.)</th>
                            <th>Date</th>
                            <th>Action</th>
                            </tr>
                            <tr v-for="toIssue in InvoiceToIssue" :key="toIssue.id">
                            <td>{{toIssue.id}}</td>
                            <td>{{toIssue.Outstanding}}</td>
                            <td>{{toIssue.updated_at}}</td>
                            <td><button class="btn btn-success" data-toggle="modal" data-target="#viewInvoiceToIssue" @click="loadAll(toIssue.id)">View</button></td>
                            </tr>
                        </tbody></table>
                    </div>
                </div>
            </div>
        </div>

        <!-- ////////////////////////////////// -->
                    <!-- ///Modal// -->
        <!-- ////////////////////////////////// -->
        <div class="modal fade" id="viewInvoiceToIssue" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Items</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card" id="printMe">
                    <div class="card-body">
                        <h5 style="text-align: center;">Invoice No:{{ID}}</h5>
                        <!-- <p>{{customerDetails.Fname}} {{customerDetails.Lname}}<br>
                        {{customerDetails.City}}<br>
                        {{customerDetails.Street}}<br>
                        Tel:{{customerDetails.No}}</p> -->
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
                                </table>
                        </div>
                    </div>
                </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="Issued()">Issue</button>
                    </div>
                    </div>
                </div>
                </div>
    </div>
</template>

<script>
// $(document).ready(function(){
//         $('#view').click(function(){
//             $('#viewInvoiceToIssue').modal({
//                 backdrop: 'static',
//                 keyboard: false
//             });
//         });
//     });
    export default {
        data(){
            return{
                ID:0,
                InvoiceToIssue:{},
                customerDetails:{},
                getItems:{},
            }
        },
        methods:{
            loadAll(id){
                //axios.get("api/customerID/"+id).then(({data}) => (this.customerDetails = data));
                this.ID=id;
                axios.get("api/getItems/"+id).then(({data}) => (this.getItems = data));
                
            },
            loadInvoicetoIssue(){
                axios.get("api/InvoiceToIssue").then(({ data }) => this.InvoiceToIssue = data);
            },
            Issued(){
                console.log(this.ID);
                axios.put('api/InvoiceToIssue/' + this.ID)
                .then( res => {
                     Swal.fire(
                              'Issued!',
                              'Item has been issued',
                              'success'
                            )
                     Fire.$emit('afterIssue');
                })
                .catch( e => {
                    console.log(e)
                })
            }
        },
        created() {
            this.loadInvoicetoIssue();
            Fire.$on('afterIssue',()=>{
                this.loadInvoicetoIssue();
            });
            console.log('Component mounted.')
        }
    }
</script>
